using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO.Ports;

namespace ATPT_Biletar
{
    public partial class Form1 : Form
    {
        public string data;
        public Form1()
        {
            InitializeComponent();
            label1.Text = data;
        }

        private void label1_Click(object sender, EventArgs e)
        {
            SerialPort port = new SerialPort("COM3", 9600, Parity.None, 8, StopBits.One);
            if (!port.IsOpen)
            {
                port.Open();
            }

            while (true)
            {
                string brojKartice = port.ReadLine();
                label1.Text = brojKartice;
            }
        }
    }
}
