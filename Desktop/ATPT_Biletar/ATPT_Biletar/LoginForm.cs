using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Net.Http;
using System.Net;
using System.IO;
using System.Web.Script.Serialization;

namespace ATPT_Biletar
{
    public partial class LoginForm : Form
    {
        public LoginForm()
        {
            InitializeComponent();
        }

        private void Login()
        {
            var httpWebRequest = (HttpWebRequest)WebRequest.Create("http://localhost/publictransportcloud/api/KorisnikAplikacije/login.php");
            httpWebRequest.ContentType = "application/json";
            httpWebRequest.Method = "POST";
            ServicePointManager.SecurityProtocol = SecurityProtocolType.Tls12 | SecurityProtocolType.Tls11 | SecurityProtocolType.Tls;

            using (var streamWriter = new StreamWriter(httpWebRequest.GetRequestStream()))
            {
                string json = new JavaScriptSerializer().Serialize(new
                {
                    email = textBox1.Text,
                    password = textBox2.Text
                });
                streamWriter.Write(json);
                streamWriter.Flush();
                streamWriter.Close();
            }

            var httpResponse = (HttpWebResponse)httpWebRequest.GetResponse();
            using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
            {
                var result = streamReader.ReadToEnd();
                if(result.Substring(10, 2) == "OK" && result.Contains("Biletar"))
                {
                    OptionForm form = new OptionForm();
                    form.Show();
                    this.Hide();
                }
                else
                {
                    label4.Text = "Greška, provjerite podatke i pokušajte ponovo";
                    textBox2.Text = "";
                }
    
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Login();
        }
    }
}
