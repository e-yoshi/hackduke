using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace InquizioPPT
{
    public partial class EditClass : Form
    {
        public EditClass()
        {
            InitializeComponent();
            addStudentBtn.Click += delegate
            {
                CreateNewStudentEntry(studentIDText.Text, studentFNameText.Text, studentLNameText.Text, studentPhoneText.Text, studentEmailText.Text);
                studentFNameText.Text = studentIDText.Text = "";
            };
            FormClosing += delegate
            {
                System.Diagnostics.Debug.WriteLine(GetClassAsString());
            };
        }

        public string GetClassAsString()
        {
            StringBuilder sb = new StringBuilder();
            for (int i = 0, n = 0; i < Controls.Count; i++)
                if ((string)Controls[i].Tag == "student")
                {
                    if (n++ > 0)
                        sb.Append(',');
                    sb.Append(Controls[i].Controls[0].Text + ',');
                    sb.Append(Controls[i].Controls[1].Text + ',');
                    sb.Append(Controls[i].Controls[2].Text + ',');
                    sb.Append(Controls[i].Controls[3].Text + ',');
                    sb.Append(Controls[i].Controls[4].Text);
                }
            return sb.ToString();
        }

        public void CreateNewStudentEntry(string StudentID, string StudentFName, string StudentLName, string StudentPhone, string StudentEmail)
        {
            Panel container = new Panel();
            container.Tag = "student";
            container.Bounds = addPanel.Bounds;

            TextBox newIDText = new TextBox();
            newIDText.Bounds = studentIDText.Bounds;
            newIDText.Text = StudentID;

            TextBox newFNameText = new TextBox();
            newFNameText.Bounds = studentFNameText.Bounds;
            newFNameText.Text = StudentFName;

            TextBox newLNameText = new TextBox();
            newLNameText.Bounds = studentLNameText.Bounds;
            newLNameText.Text = StudentLName;

            MaskedTextBox newPhoneText = new MaskedTextBox();
            newPhoneText.Bounds = studentPhoneText.Bounds;
            newPhoneText.Mask = studentPhoneText.Mask;
            newPhoneText.PromptChar = studentPhoneText.PromptChar;
            newPhoneText.Text = StudentPhone;

            TextBox newEmailText = new TextBox();
            newEmailText.Bounds = studentEmailText.Bounds;
            newEmailText.Text = StudentEmail;

            Button remBtn = new Button();
            remBtn.BackColor = Color.Tomato;
            remBtn.ForeColor = Color.White;
            remBtn.Bounds = addStudentBtn.Bounds;
            remBtn.Text = "Remove";
            remBtn.Click += remBtn_Click;

            container.Controls.AddRange(new Control[] { newIDText, newFNameText, newLNameText, newPhoneText, newEmailText, remBtn });

            addPanel.Top = container.Bottom + 10;
            Controls.Add(container);
            studentIDText.Focus();
        }

        void remBtn_Click(object sender, EventArgs e)
        {
            var ctl = (Control)sender;
            for (int i = 0; i < Controls.Count; i++)
                if (Controls[i].Top > ctl.Parent.Top)
                    Controls[i].Top -= ctl.Parent.Height + 10;
            Controls.Remove(ctl.Parent);
        }
    }
}
