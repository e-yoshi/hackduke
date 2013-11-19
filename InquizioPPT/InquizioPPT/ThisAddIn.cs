using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Xml.Linq;
using PowerPoint = Microsoft.Office.Interop.PowerPoint;
using Office = Microsoft.Office.Core;
using Microsoft.Office.Tools.Ribbon;
using System.Net;
using System.IO;

//This code is ugly, but thank MS for that (Thanks Obama)
namespace InquizioPPT
{
    public partial class ThisAddIn
    {
        /// <summary>
        /// Network host to connect to
        /// </summary>
        internal string NetHost { get; set; }
        /// <summary>
        /// Network host to connect to for secondary things
        /// </summary>
        internal string NetHost2 { get; set; }
        /// <summary>
        /// The teacher's name
        /// </summary>
        internal string TeacherName { get; set; }
        /// <summary>
        /// The teacher's password
        /// </summary>
        internal string TeacherPassword { private get; set; }
        /// <summary>
        /// The current class ID
        /// </summary>
        internal int CurrentClassID { get; set; }

        //current number of questions and responses registered
        private int numQuestions;
        private int numResults;

        private void ThisAddIn_Startup(object sender, System.EventArgs e)
        {
            //load settings
            NetHost = "http://HackDuke.azurewebsites.net/query.php";
            NetHost2 = "http://HackDuke.azurewebsites.net/twilio-send.php";
            TeacherName = "Test";
            TeacherPassword = "asdfasdfasdf";
            numQuestions = 0;
            CurrentClassID = 1;

            var rbn = Globals.Ribbons.Ribbon1;
            this.Application.PresentationNewSlide += new PowerPoint.EApplication_PresentationNewSlideEventHandler(Application_PresentationNewSlide);
            this.Application.SlideShowNextSlide += Application_SlideShowNextSlide;
            this.Application.SlideShowEnd += Application_SlideShowEnd;
            rbn.QuestionBtn.Click += QuestionBtn_Click;
            rbn.ResultsBtn.Click += ResultsBtn_Click;
            rbn.settingsBtn.Click += settingsBtn_Click;
            rbn.conSettingsBtn.Click += settingsBtn_Click;
            rbn.edClassBtn.Click += edClassBtn_Click;

            //populate classes
            Dictionary<string, string> post = new Dictionary<string, string>();
            post.Add("Query", "GetClasses");
            var classes = PostResponse(NetHost, post).Split(',');
            var ribinz = Globals.Factory.GetRibbonFactory();
            for (int i = 1; i <= classes.Length; i++)
            {
                var btn = ribinz.CreateRibbonButton();
                btn.Name = "_class_" + i;
                btn.Label = "Class " + i;
                btn.Description = btn.Label;
                rbn.selClass.Buttons.Add(btn);
            }
        }

        void edClassBtn_Click(object sender, RibbonControlEventArgs e)
        {
            Dictionary<string, string> post = new Dictionary<string, string>();
            post.Add("Query", "GetStudentsInfo");
            post.Add("ClassId", CurrentClassID.ToString());
            var result = PostResponse(NetHost, post).Split(',');

            EditClass ed = new EditClass();
            for (int i = 0; i < result.Length && result.Length > (i / 5f) + 1; i += 5)
                ed.CreateNewStudentEntry(result[i], result[i + 1], result[i + 2], result[i + 3], result[i + 4]);
            ed.ShowDialog();
            post.Clear();
            post.Add("Query", "SetStudentsInfo");
            post.Add("StudentsInfo", ed.GetClassAsString());
            PostResponse(NetHost, post);
        }

        /// <summary>
        /// reset settings
        /// </summary>
        /// <param name="Pres"></param>
        void Application_SlideShowEnd(PowerPoint.Presentation Pres)
        {
            foreach (var slide in Pres.Slides)
                foreach (var shape in ((PowerPoint.Slide)slide).Shapes)
                {
                    var shp = (PowerPoint.Shape)shape;
                    if (shp.Tags["Inquizio_Result_Table"] != "")
                    {
                        for (int i = 1; i <= shp.Table.Columns.Count; i++)
                            for (int j = 1; j <= shp.Table.Columns[i].Cells.Count; j++)
                                shp.Table.Columns[i].Cells[j].Shape.TextFrame.TextRange.Text = "";
                    }
                    else if (shp.Tags["Inquizio_Question"] != "")
                    {
                        shp.ShapeStyle = Office.MsoShapeStyleIndex.msoLineStylePreset1;
                        shp.Line.DashStyle = Office.MsoLineDashStyle.msoLineDash;
                        shp.Line.ForeColor.RGB = 0xff8800;
                    }
                }
        }

        void Application_SlideShowNextSlide(PowerPoint.SlideShowWindow Wn)
        {
            var slide = Wn.View.Slide;
            if (slide.Shapes.HasTitle == Office.MsoTriState.msoFalse)
                return;
            var title = slide.Shapes.Title;
            //questions
            if (slide.Shapes.HasTitle == Office.MsoTriState.msoTrue && title.Tags["Inquizio_Question"] != "")
            {
                //make sure no extra settings have been applied to negate the style
                if (title.Line.DashStyle == Office.MsoLineDashStyle.msoLineDash && title.Line.ForeColor.RGB == 0xff8800)
                    title.Line.Visible = Office.MsoTriState.msoFalse;

                //send post
                Dictionary<string, string> post = new Dictionary<string, string>();
                post.Add("Query", "CreateQuestion");
                post.Add("ClassId", CurrentClassID.ToString());
                post.Add("TeacherName", TeacherName);
                post.Add("TeacherPassword", TeacherPassword);
                post.Add("Question", title.TextFrame.TextRange.Text.Trim());
                //System.Diagnostics.Debug.WriteLine(PostResponse(NetHost, post)); //now in twilio-send
                post.Clear();
                post.Add("ClassId", CurrentClassID.ToString());
                System.Diagnostics.Debug.WriteLine(PostResponse(NetHost2, post));
            }
            //results
            else if (title.Tags["Inquizio_Result"] != "")
            {
                //set a specific style to the modified question box
                var post = new Dictionary<string, string>();
                post.Add("Query", "GetResponse");
                post.Add("ClassId", "1");
                post.Add("Question", title.TextFrame.TextRange.Text.Trim());
                var response = PostResponse(NetHost, post);
                System.Diagnostics.Debug.WriteLine(response);
                var result = response.Split(',');

                Dictionary<string, int> scores = new Dictionary<string, int>();
                for (int i = 1; i < result.Length; i += 2)
                {
                    //TODO: save scores to CSV here
                    if (scores.ContainsKey(result[i]))
                        scores[result[i]]++;
                    else
                        scores.Add(result[i], 1);
                }

                PowerPoint.Shape table = null;
                foreach (var shape in slide.Shapes)
                {
                    var shp = (PowerPoint.Shape)shape;
                    if (shp.Tags["Inquizio_Result_Table"] != "")
                    {
                        table = shp;
                        break;
                    }
                }
                if (table != null)
                {
                    for (int i = 2; i <= scores.Count; i++)
                        table.Table.Columns.Add();

                    int j = 1;
                    foreach (var kvp in scores)
                    {
                        table.Table.Cell(1, j).Shape.TextFrame.TextRange.Text = kvp.Value.ToString();
                        table.Table.Cell(2, j).Shape.TextFrame.TextRange.Text = kvp.Key;
                        j++;
                    }
                }
            }
        }

        private void ThisAddIn_Shutdown(object sender, System.EventArgs e) { }
        private void Application_PresentationNewSlide(PowerPoint.Slide Slide) { }

        void QuestionBtn_Click(object sender, RibbonControlEventArgs e)
        {
            var slide = (PowerPoint.Slide)Application.ActiveWindow.View.Slide;
            var title = slide.Shapes.HasTitle == Office.MsoTriState.msoTrue ? slide.Shapes.Title : slide.Shapes.AddTitle();

            if (title.Tags["Inquizio_Result"] != "")
                System.Windows.Forms.MessageBox.Show("There is already a question panel on this page.\n(To remove it, Delete the title)", "Error",
                    System.Windows.Forms.MessageBoxButtons.OK, System.Windows.Forms.MessageBoxIcon.Error);
            else
            {
                //set a specific style to the modified question box
                title.ShapeStyle = Office.MsoShapeStyleIndex.msoLineStylePreset1;
                title.Line.DashStyle = Office.MsoLineDashStyle.msoLineDash;
                title.Line.ForeColor.RGB = 0xff8800;
                title.Tags.Add("Inquizio_Question", numQuestions++.ToString());
            }
        }

        void ResultsBtn_Click(object sender, RibbonControlEventArgs e)
        {
            var slide = (PowerPoint.Slide)Application.ActiveWindow.View.Slide;
            var title = slide.Shapes.HasTitle == Office.MsoTriState.msoTrue ? slide.Shapes.Title : slide.Shapes.AddTitle();
            if (title.Tags["Inquizio_Question"] != "")
                System.Windows.Forms.MessageBox.Show("There is already a question panel on this page.\n(To remove it, Delete the title)", "Error",
                    System.Windows.Forms.MessageBoxButtons.OK, System.Windows.Forms.MessageBoxIcon.Error);
            else
            {
                title.Tags.Add("Inquizio_Result", numResults++.ToString());
                var table = slide.Shapes.AddTable(2, 2, -1, -1, 500, 300);
                table.Tags.Add("Inquizio_Result_Table", "not null");
                //var chart = slide.Shapes.AddChart2(-1, Office.XlChartType.xlColumnClustered, -1, -1, 300, 300, true);
                //chart.Chart.HasLegend = false;
                //chart.Chart.ChartData.Workbook.Worksheet.Cells.ClearContents();
            }
        }

        void settingsBtn_Click(object sender, RibbonControlEventArgs e)
        {
            System.Windows.Forms.MessageBox.Show("Not Implemented\nTry again later.", "Not Implemented",
                System.Windows.Forms.MessageBoxButtons.OK, System.Windows.Forms.MessageBoxIcon.Error);
        }

        #region Net Code

        /// <summary>
        /// Request a string from a web server
        /// </summary>
        /// <param name="Host">The host to connect to</param>
        /// <param name="PostData">The POST data to submit</param>
        /// <returns>The result string</returns>
        string PostResponse(string Host, Dictionary<string, string> PostData)
        {
            try
            {
                WebRequest request = WebRequest.Create(Host);
                request.Method = "POST";

                StringBuilder postData = new StringBuilder();
                if (PostData != null)
                {
                    foreach (var post in PostData)
                    {
                        if (postData.Length > 0)
                            postData.Append('&');
                        postData.Append(post.Key + '=' + post.Value);
                    }
                }

                byte[] byteArray = Encoding.UTF8.GetBytes(postData.ToString());
                request.ContentType = "application/x-www-form-urlencoded";
                request.ContentLength = byteArray.Length;

                Stream dataStream = request.GetRequestStream();
                dataStream.Write(byteArray, 0, byteArray.Length);
                dataStream.Close();
                var result = request.GetResponse();
                dataStream = result.GetResponseStream();
                StreamReader reader = new StreamReader(dataStream);

                string status = ((HttpWebResponse)result).StatusDescription; //not used
                string responseFromServer = reader.ReadToEnd();

                reader.Close();
                dataStream.Close();
                return responseFromServer;
            }
            catch (Exception expt)
            {
                System.Windows.Forms.MessageBox.Show(expt.Message, "Error", System.Windows.Forms.MessageBoxButtons.OK, System.Windows.Forms.MessageBoxIcon.Error);
                return "";
            }
        }

        #endregion

        #region VSTO generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InternalStartup()
        {
            this.Startup += new System.EventHandler(ThisAddIn_Startup);
            this.Shutdown += new System.EventHandler(ThisAddIn_Shutdown);
        }

        #endregion
    }
}
