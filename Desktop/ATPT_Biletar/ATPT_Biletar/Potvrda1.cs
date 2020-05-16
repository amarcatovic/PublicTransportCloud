using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ATPT_Biletar
{
    public partial class Potvrda1 : Form
    {
        public Potvrda1()
        {
            InitializeComponent();
            label1.Text = AddUser.ime;
            label2.Text = AddUser.prezime;
            label3.Text = "Login: " + AddUser.email;
            label4.Text = "Lozinka: " + AddUser.pw;
            label5.Text = AddUser.dob;
            label6.Text = AddUser.card;
            label7.Text = AddUser.stanje + "KM";
        }

        private void button1_Click(object sender, EventArgs e)
        {
            OptionForm o = new OptionForm();
            o.Show();
            this.Close();
        }
    }
}
