using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.IO.Ports;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Web.Script.Serialization;
using System.Windows.Forms;

namespace ATPT_Biletar
{
    public partial class Nadopuna : Form
    {
        public Nadopuna()
        {
            InitializeComponent();
        }
        private void Ucitaj()
        {
            SerialPort port = new SerialPort("COM4", 9600, Parity.None, 8, StopBits.One);
            if (!port.IsOpen)
            {
                port.Open();
            }

            //while (true)
            //{
            string brojKartice = port.ReadLine();
            textBox1.Text = brojKartice;
            port.Close();
            //}
        }

        private void Add()
        {
            var httpWebRequest = (HttpWebRequest)WebRequest.Create("http://localhost/publictransportcloud/api/Nadopune/create.php");
            httpWebRequest.ContentType = "application/json";
            httpWebRequest.Method = "POST";
            ServicePointManager.SecurityProtocol = SecurityProtocolType.Tls12 | SecurityProtocolType.Tls11 | SecurityProtocolType.Tls;

            using (var streamWriter = new StreamWriter(httpWebRequest.GetRequestStream()))
            {
                string json = new JavaScriptSerializer().Serialize(new
                {
                    brojKartice = textBox1.Text,
                    kolicina = textBox2.Text,
                    prodajnoMjesto_id = "2"
                });
                streamWriter.Write(json);
                streamWriter.Flush();
                streamWriter.Close();
            }

            var httpResponse = (HttpWebResponse)httpWebRequest.GetResponse();
            using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
            {
                var result = streamReader.ReadToEnd();
                label1.Text = result.Substring(11, 11);
                if (result.Substring(11, 11) == "Nadopunjeno")
                {
                    OptionForm o = new OptionForm();
                    o.Show();
                    this.Close();
                }
                else
                {
                    label4.Text = "Greška, provjerite podatke i pokušajte ponovo";
                }

            }
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void label2_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            textBox1.Text = textBox1.Text.Replace("\r", "");
            Add();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Ucitaj();
        }
    }
}
