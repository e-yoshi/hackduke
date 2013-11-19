namespace InquizioPPT
{
    partial class EditClass
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

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

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.addPanel = new System.Windows.Forms.Panel();
            this.addStudentBtn = new System.Windows.Forms.Button();
            this.studentFNameText = new System.Windows.Forms.TextBox();
            this.studentIDText = new System.Windows.Forms.TextBox();
            this.studentLNameText = new System.Windows.Forms.TextBox();
            this.studentPhoneText = new System.Windows.Forms.MaskedTextBox();
            this.studentEmailText = new System.Windows.Forms.TextBox();
            this.label5 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.addPanel.SuspendLayout();
            this.SuspendLayout();
            // 
            // addPanel
            // 
            this.addPanel.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.addPanel.Controls.Add(this.studentEmailText);
            this.addPanel.Controls.Add(this.studentPhoneText);
            this.addPanel.Controls.Add(this.studentLNameText);
            this.addPanel.Controls.Add(this.addStudentBtn);
            this.addPanel.Controls.Add(this.studentFNameText);
            this.addPanel.Controls.Add(this.studentIDText);
            this.addPanel.Location = new System.Drawing.Point(3, 34);
            this.addPanel.Name = "addPanel";
            this.addPanel.Size = new System.Drawing.Size(676, 24);
            this.addPanel.TabIndex = 7;
            // 
            // addStudentBtn
            // 
            this.addStudentBtn.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.addStudentBtn.BackColor = System.Drawing.SystemColors.ButtonFace;
            this.addStudentBtn.Location = new System.Drawing.Point(612, -1);
            this.addStudentBtn.Name = "addStudentBtn";
            this.addStudentBtn.Size = new System.Drawing.Size(63, 24);
            this.addStudentBtn.TabIndex = 5;
            this.addStudentBtn.Text = "Add";
            this.addStudentBtn.UseVisualStyleBackColor = false;
            // 
            // studentFNameText
            // 
            this.studentFNameText.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left)));
            this.studentFNameText.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F);
            this.studentFNameText.Location = new System.Drawing.Point(81, 0);
            this.studentFNameText.Name = "studentFNameText";
            this.studentFNameText.Size = new System.Drawing.Size(100, 23);
            this.studentFNameText.TabIndex = 1;
            // 
            // studentIDText
            // 
            this.studentIDText.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F);
            this.studentIDText.Location = new System.Drawing.Point(0, 0);
            this.studentIDText.Name = "studentIDText";
            this.studentIDText.Size = new System.Drawing.Size(75, 23);
            this.studentIDText.TabIndex = 0;
            // 
            // studentLNameText
            // 
            this.studentLNameText.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.studentLNameText.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F);
            this.studentLNameText.Location = new System.Drawing.Point(187, 0);
            this.studentLNameText.Name = "studentLNameText";
            this.studentLNameText.Size = new System.Drawing.Size(101, 23);
            this.studentLNameText.TabIndex = 2;
            // 
            // studentPhoneText
            // 
            this.studentPhoneText.AllowPromptAsInput = false;
            this.studentPhoneText.AsciiOnly = true;
            this.studentPhoneText.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F);
            this.studentPhoneText.Location = new System.Drawing.Point(293, 0);
            this.studentPhoneText.Mask = "(###) ###-####";
            this.studentPhoneText.Name = "studentPhoneText";
            this.studentPhoneText.PromptChar = '…';
            this.studentPhoneText.Size = new System.Drawing.Size(100, 23);
            this.studentPhoneText.TabIndex = 3;
            // 
            // studentEmailText
            // 
            this.studentEmailText.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.studentEmailText.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F);
            this.studentEmailText.Location = new System.Drawing.Point(399, 0);
            this.studentEmailText.Name = "studentEmailText";
            this.studentEmailText.Size = new System.Drawing.Size(207, 23);
            this.studentEmailText.TabIndex = 4;
            // 
            // label5
            // 
            this.label5.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.label5.AutoSize = true;
            this.label5.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label5.Location = new System.Drawing.Point(410, 9);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(42, 16);
            this.label5.TabIndex = 4;
            this.label5.Text = "Email";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label4.Location = new System.Drawing.Point(197, 9);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(73, 16);
            this.label4.TabIndex = 2;
            this.label4.Text = "Last Name";
            // 
            // label3
            // 
            this.label3.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.label3.AutoSize = true;
            this.label3.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label3.Location = new System.Drawing.Point(304, 9);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(98, 16);
            this.label3.TabIndex = 3;
            this.label3.Text = "Phone Number";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(91, 9);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(73, 16);
            this.label2.TabIndex = 1;
            this.label2.Text = "First Name";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(7, 9);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(69, 16);
            this.label1.TabIndex = 0;
            this.label1.Text = "Student ID";
            // 
            // EditClass
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.AutoScroll = true;
            this.ClientSize = new System.Drawing.Size(679, 441);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.addPanel);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedToolWindow;
            this.Name = "EditClass";
            this.ShowIcon = false;
            this.ShowInTaskbar = false;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent;
            this.Text = "Edit Class";
            this.addPanel.ResumeLayout(false);
            this.addPanel.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Panel addPanel;
        private System.Windows.Forms.Button addStudentBtn;
        private System.Windows.Forms.TextBox studentFNameText;
        private System.Windows.Forms.TextBox studentIDText;
        private System.Windows.Forms.TextBox studentLNameText;
        private System.Windows.Forms.MaskedTextBox studentPhoneText;
        private System.Windows.Forms.TextBox studentEmailText;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;
    }
}