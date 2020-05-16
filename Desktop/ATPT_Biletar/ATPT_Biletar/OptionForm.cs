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
    public partial class OptionForm : Form
    {
        public OptionForm()
        {
            InitializeComponent();
        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {

        }
        private void pictureBox2_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            AddUser user = new AddUser();
            user.Show();
            this.Close();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Nadopuna user = new Nadopuna();
            user.Show();
            this.Close();
        }
    }
}
