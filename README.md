### thinderfinal

## Inspiration
We aren't sure how we came up with the idea of Thinder. We started with the idea of webscraping something, and ended up with a dating app... but for therapists and clients...

## What it does
Thinder allows you to swipe and find the details of your therapist right on our connect page!! 
We also prevent doxxing! Cant have a 16 year old script kitty doxxing you if you've doxxed yourself first on our publically accessible connect page.

## How we built it
This site had many changes and challenges along the way. 
We started by setting up a Raspberry Pi as an access point using hostapd to setup a 2.4Ghz network, so that judges can connect to our site during demo day. We then used dnsmasq to create a fake domain for our host ip; this allowed users to enter "final.thinder.com" to find our site, instead of "192.168.4.1". Following this, we created an apache2 server to host our site, and a mariadb server linked to our webserver to save our data. We then coded the html, javascript, css, and php pages we needed to make a beautiful site.

## Challenges we ran into
We restarted. Six. Times. We ran into many roadblocks along the way like using svelte, nodejs, react, mongodb, using the raspberry pi as both a host and client, etc.
Here's what each member has to say:
Eddie - I managed a lot of stuff involving our webserver host. Getting all the components to work was a hassle. Svelte had a lack of compatibility and integration into our setup, mongodb stopped supporting our OS, nodeJS and vite didn't compile half the time to build, react didn't create a proper build folder which apache2 liked to use, our raspberry pi couldn't use wlan0 as both an access point host and client, mariadb randomly forgot the password (yes, actually randomly. Its a current bug), the list goes on. All I can do is thank my teammates for adapting to every twist and turn that was thrown at them.
Nick - We came into the competition with no real structure of what we wanted to use, which hindered us for about the first 8 hours as they were spent mostly just trying to get us to a platform we were all happy with. I struggled mainly with getting the correct data to send to our SQL server. 
Ayden - Learning different styles and structures of programming was a challenge for me. As someone who has little web development knowledge, the meaning of "raspberry pies" and "local server networks" had not dawned on me. The hardest part was just trying to be productive and useful with a langauge I had never used before.
Cole - Before this, I never worked with a raspberry pi and never would of thought of running a server on it. I haven't gotten into networking and working with databases either so when our team decided to run the database server on the raspberry pi and use an encryption thing, I was astounded. I also developed crazy CSS and HTML skills because I'd messed with these before, I always used project templates and frameworks.

## Accomplishments that we're proud of
Our group was happy with our end product and we all felt useful despite coming in with little knowledge of website programming. Setting up a Raspberry pi as an access because we ran into problems like connecting to internet and compatibility issues. For example, we restarted our projected six times because we started with using svelte and tried using mongoDB. Something kept happening when we were downloading dependencies so we switched to React but something with the finding the right database was an issue. So finally, we decided to stick to the basics with html and CSS, then keep rolling.

## What we learned
We learned that website programming is difficult but manageable if you know the strengths and weaknesses of your respective programming languages. We learned that you should research what to use for a hackathon before hand because we had to restart so many times for dumb reasons that wasted so much time.

## What's next for Thinder
We hope to make our pages more professional, migrate to a better language, and deploy our website to the actual internet. Another thing that we would like to implement would be an algorithm for the users based on location and therapists who would like to handle their issues. Something that we didn't get to was the ability for therapists to match with clients because only clients can match with therapists at the moment. 