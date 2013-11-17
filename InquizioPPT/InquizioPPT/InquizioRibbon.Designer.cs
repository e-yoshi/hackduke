namespace InquizioPPT
{
    partial class InquizioRibbon : Microsoft.Office.Tools.Ribbon.RibbonBase
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        public InquizioRibbon()
            : base(Globals.Factory.GetRibbonFactory())
        {
            InitializeComponent();
        }

        /// <summary> 
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Component Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.InquizioTab = this.Factory.CreateRibbonTab();
            this.slidesGroup = this.Factory.CreateRibbonGroup();
            this.QuestionBtn = this.Factory.CreateRibbonButton();
            this.ResultsBtn = this.Factory.CreateRibbonButton();
            this.classGroup = this.Factory.CreateRibbonGroup();
            this.edClassBtn = this.Factory.CreateRibbonButton();
            this.addClassBtn = this.Factory.CreateRibbonButton();
            this.selcClassDescript = this.Factory.CreateRibbonButton();
            this.selClass = this.Factory.CreateRibbonDropDown();
            this.settingsGroup = this.Factory.CreateRibbonGroup();
            this.settingsBtn = this.Factory.CreateRibbonSplitButton();
            this.conSettingsBtn = this.Factory.CreateRibbonButton();
            this.TeacherInfoBtn = this.Factory.CreateRibbonButton();
            this.InquizioTab.SuspendLayout();
            this.slidesGroup.SuspendLayout();
            this.classGroup.SuspendLayout();
            this.settingsGroup.SuspendLayout();
            // 
            // InquizioTab
            // 
            this.InquizioTab.Groups.Add(this.slidesGroup);
            this.InquizioTab.Groups.Add(this.classGroup);
            this.InquizioTab.Groups.Add(this.settingsGroup);
            this.InquizioTab.Label = "INQUIZIO";
            this.InquizioTab.Name = "InquizioTab";
            // 
            // slidesGroup
            // 
            this.slidesGroup.Items.Add(this.QuestionBtn);
            this.slidesGroup.Items.Add(this.ResultsBtn);
            this.slidesGroup.Label = "Controls";
            this.slidesGroup.Name = "slidesGroup";
            // 
            // QuestionBtn
            // 
            this.QuestionBtn.ControlSize = Microsoft.Office.Core.RibbonControlSize.RibbonControlSizeLarge;
            this.QuestionBtn.Label = "Question Box";
            this.QuestionBtn.Name = "QuestionBtn";
            this.QuestionBtn.OfficeImageId = "BuildTeam";
            this.QuestionBtn.ShowImage = true;
            this.QuestionBtn.SuperTip = "Insert a question field (Gives a title)";
            // 
            // ResultsBtn
            // 
            this.ResultsBtn.ControlSize = Microsoft.Office.Core.RibbonControlSize.RibbonControlSizeLarge;
            this.ResultsBtn.Label = "Results Box";
            this.ResultsBtn.Name = "ResultsBtn";
            this.ResultsBtn.OfficeImageId = "CalculateSheet";
            this.ResultsBtn.ShowImage = true;
            this.ResultsBtn.SuperTip = "Create an area to display results from a question";
            // 
            // classGroup
            // 
            this.classGroup.Items.Add(this.edClassBtn);
            this.classGroup.Items.Add(this.addClassBtn);
            this.classGroup.Items.Add(this.selcClassDescript);
            this.classGroup.Items.Add(this.selClass);
            this.classGroup.Label = "Classes";
            this.classGroup.Name = "classGroup";
            // 
            // edClassBtn
            // 
            this.edClassBtn.ControlSize = Microsoft.Office.Core.RibbonControlSize.RibbonControlSizeLarge;
            this.edClassBtn.Label = "Edit Class";
            this.edClassBtn.Name = "edClassBtn";
            this.edClassBtn.OfficeImageId = "ConflictViewEnter";
            this.edClassBtn.ShowImage = true;
            // 
            // addClassBtn
            // 
            this.addClassBtn.Label = "Add Class";
            this.addClassBtn.Name = "addClassBtn";
            this.addClassBtn.OfficeImageId = "NewTaskRequest";
            this.addClassBtn.ShowImage = true;
            // 
            // selcClassDescript
            // 
            this.selcClassDescript.Label = "Selected Class";
            this.selcClassDescript.Name = "selcClassDescript";
            this.selcClassDescript.OfficeImageId = "OpenMyDepartmentCalendar";
            this.selcClassDescript.ShowImage = true;
            // 
            // selClass
            // 
            this.selClass.Label = "Selected Class";
            this.selClass.Name = "selClass";
            this.selClass.ShowLabel = false;
            // 
            // settingsGroup
            // 
            this.settingsGroup.Items.Add(this.settingsBtn);
            this.settingsGroup.Label = "Settings";
            this.settingsGroup.Name = "settingsGroup";
            // 
            // settingsBtn
            // 
            this.settingsBtn.ControlSize = Microsoft.Office.Core.RibbonControlSize.RibbonControlSizeLarge;
            this.settingsBtn.Items.Add(this.conSettingsBtn);
            this.settingsBtn.Items.Add(this.TeacherInfoBtn);
            this.settingsBtn.Label = "Settings";
            this.settingsBtn.Name = "settingsBtn";
            this.settingsBtn.OfficeImageId = "ConnectionSettings";
            this.settingsBtn.SuperTip = "Configure server settings";
            // 
            // conSettingsBtn
            // 
            this.conSettingsBtn.Label = "Connection Settings";
            this.conSettingsBtn.Name = "conSettingsBtn";
            this.conSettingsBtn.OfficeImageId = "ConnectionSettings";
            this.conSettingsBtn.ShowImage = true;
            this.conSettingsBtn.SuperTip = "Edit or view the current connection settings";
            // 
            // TeacherInfoBtn
            // 
            this.TeacherInfoBtn.Label = "Teacher Info";
            this.TeacherInfoBtn.Name = "TeacherInfoBtn";
            this.TeacherInfoBtn.OfficeImageId = "ContactProperties";
            this.TeacherInfoBtn.ShowImage = true;
            // 
            // InquizioRibbon
            // 
            this.Name = "InquizioRibbon";
            this.RibbonType = "Microsoft.PowerPoint.Presentation";
            this.Tabs.Add(this.InquizioTab);
            this.Load += new Microsoft.Office.Tools.Ribbon.RibbonUIEventHandler(this.InquizioRibbon_Load);
            this.InquizioTab.ResumeLayout(false);
            this.InquizioTab.PerformLayout();
            this.slidesGroup.ResumeLayout(false);
            this.slidesGroup.PerformLayout();
            this.classGroup.ResumeLayout(false);
            this.classGroup.PerformLayout();
            this.settingsGroup.ResumeLayout(false);
            this.settingsGroup.PerformLayout();

        }

        #endregion

        internal Microsoft.Office.Tools.Ribbon.RibbonTab InquizioTab;
        internal Microsoft.Office.Tools.Ribbon.RibbonGroup settingsGroup;
        internal Microsoft.Office.Tools.Ribbon.RibbonGroup slidesGroup;
        internal Microsoft.Office.Tools.Ribbon.RibbonButton QuestionBtn;
        internal Microsoft.Office.Tools.Ribbon.RibbonButton ResultsBtn;
        internal Microsoft.Office.Tools.Ribbon.RibbonSplitButton settingsBtn;
        internal Microsoft.Office.Tools.Ribbon.RibbonButton edClassBtn;
        internal Microsoft.Office.Tools.Ribbon.RibbonButton TeacherInfoBtn;
        internal Microsoft.Office.Tools.Ribbon.RibbonButton conSettingsBtn;
        internal Microsoft.Office.Tools.Ribbon.RibbonGroup classGroup;
        internal Microsoft.Office.Tools.Ribbon.RibbonDropDown selClass;
        internal Microsoft.Office.Tools.Ribbon.RibbonButton addClassBtn;
        internal Microsoft.Office.Tools.Ribbon.RibbonButton selcClassDescript;
    }

    partial class ThisRibbonCollection
    {
        internal InquizioRibbon Ribbon1
        {
            get { return this.GetRibbon<InquizioRibbon>(); }
        }
    }
}
