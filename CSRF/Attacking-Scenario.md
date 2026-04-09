#Attack Scenario: How CSRF Works

###The Setup
Imagine you are logged into **Facebook**. In another tab, you open a website that offers a **"Cracking Service"** or any **"Hacker Web"**. 

That poisonous website has a hidden form designed to trick your browser. 

###The Malicious Code
This is what the hacker's code looks like (hidden from you):

```html
<!DOCTYPE html>
<html>
 <head>
    <title>You Won a Prize!</title>
 </head>
 <body onload="document.forms[0].submit()"> 
    <h1>مبروك! كسبت جايزة، جاري التحميل...</h1>
    <form action="[http://facebook.com/update-profile.php](http://facebook.com/update-profile.php)" method="POST" style="display:none;">        
        <input type="hidden" name="email" value="hacker@evil.com">        
    </form>
 </body>
</html>
What is happening here?
```
If Facebook doesn't use CSRF Tokens (and relies only on cookies):

Your email will be changed without you knowing.
Because your browser saved your Cookies from the last login,
you don't need to log in again.
The hacker tricks your browser into sending a request to you 
profile to change the email. Since the cookies are there, Facebook
thinks it's a legitimate request from YOU.
How we make it safe (With CSRF Tokens)

    First: Cookies are sent to the backend with your session ID.

    Second: The server answers you with a unique Token in a hidden value.

Every POST method used in an HTTP request sends that
token to the backend to make sure it's really you.
Why the hacker fails:

In the hacker's hidden form, the Token is NOT FOUND.

When the backend checks the request and sees no token, the form is DROPPED.

The hacker fails because of the SOP (Same-Origin Policy).
SOP (Same-Origin Policy): is a browser security rule that 
prevents one website (like hacker.com) from reading data inside another website
(like facebook.com). Since the hacker cannot READ your page,
he cannot SEE or steal the hidden token!
