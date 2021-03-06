﻿using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO.Ports;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Web.Script.Serialization;
using System.Net;
using System.IO;

namespace ATPT_Biletar
{
    public partial class AddUser : Form
    {
        public static string ime = "";
        public static string prezime = "";
        public static string email = "";
        public static string pw = "";
        public static string dob = "";
        public static string card = "";
        public static string stanje = "";


        private void Ucitaj()
        {
            textBox8.Text = "";
            SerialPort port = new SerialPort("COM5", 9600, Parity.None, 8, StopBits.One);
            if (!port.IsOpen)
            {
                port.Open();
            }
            else
            {
                port.Close();
                port.Open();
            }

            //while (true)
            //{
                string brojKartice = port.ReadLine();
                textBox8.Text = brojKartice;
            port.Close();
            //}
        }
        private void UcitajFix()
        {
            System.Threading.Thread.Sleep(1000);
            textBox8.Text = "1870590";
        }
        public AddUser()
        {
            InitializeComponent();
        }

        private void Add()
        {
            var httpWebRequest = (HttpWebRequest)WebRequest.Create("http://localhost/publictransportcloud/api/Korisnik/create.php");
            httpWebRequest.ContentType = "application/json";
            httpWebRequest.Method = "POST";
            ServicePointManager.SecurityProtocol = SecurityProtocolType.Tls12 | SecurityProtocolType.Tls11 | SecurityProtocolType.Tls;

            using (var streamWriter = new StreamWriter(httpWebRequest.GetRequestStream()))
            {
                string json = new JavaScriptSerializer().Serialize(new
                {
                    ime = textBox1.Text,
                    prezime = textBox2.Text,
                    email = textBox3.Text,
                    password = textBox5.Text + textBox7.Text + textBox6.Text,
                    datum = textBox5.Text + "-" + textBox7.Text + "-" + textBox6.Text,
                    grad_id = "1",
                    brojKartice = textBox8.Text,
                    stanje = textBox9.Text 
                });
                streamWriter.Write(json);
                streamWriter.Flush();
                streamWriter.Close();
            }

            var httpResponse = (HttpWebResponse)httpWebRequest.GetResponse();
            using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
            {
                var result = streamReader.ReadToEnd();
                if (result.Substring(11, 2) == "OK")
                {
                    Potvrda1 form = new Potvrda1();
                    form.Show();
                }
                else
                {
                    label11.Text = "Greška, provjerite podatke i pokušajte ponovo";
                }

            }
        }


        private void label3_Click(object sender, EventArgs e)
        {

        }

        private void label5_Click(object sender, EventArgs e)
        {

        }

        private void label9_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            textBox8.Text = textBox8.Text.Replace("\r", "");
            AddUser.ime = textBox1.Text;
            AddUser.prezime = textBox2.Text;
            AddUser.email = textBox3.Text;
            AddUser.pw = textBox5.Text + textBox7.Text + textBox6.Text;
            AddUser.dob = textBox5.Text + "-" + textBox7.Text + "-" + textBox6.Text;
            AddUser.card = textBox8.Text;
            AddUser.stanje = textBox9.Text;
            Add();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            UcitajFix();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            OptionForm of = new OptionForm();
            of.Show();
            this.Close();
        }
    }
}
