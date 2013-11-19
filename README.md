Inquizio
========
Overview
--------
**Inquizio** is a PowerPoint plugin and web server that allows for interactive and inline quizzes to be placed inside a PowerPoint presentation. Upon advancing to a slide with a quiz question, the plugin will automatically contact the web server and use *Twilio* to send text messages to each of the students registered and can also send an email through *SendGrid* (This can be verified by the blue box around the title disappearing). Upon advancing to the results screen, results are displayed based on any responses received up to that point.

Requirements
------------
1. Microsoft Powerpoint (Built and tested with 2013)
2. To Build: Visual Studio (Built and tested with 2013, should work with older versions) and the MS Office Dev. Tools
3. Web server with MySQL and PHP
4. Twilio and SendGrid Account

Installation
------------
	In PowerPoint, File > Options > Add-ins > Manage [PowerPoint Add-ins] Go... (At the bottom) > Add... > Select PPA file

Usage
-----
1. Naviage to the [**INQUIZIO**] tab
2. On any slide, click the [**Question Box**] button to create a new question. The title area will now have a blue box around it to signify the question is interactive. Edit the title as necessary (It will be sent with the email).
3. On any following slide, click the [**Results Box**] to create a results page. This will add a table that will be populated by the results upon advancing to the slide. This slide can be revisited for the results to be updated (Note, results are not currently saved between questions).
4. To modify the students in the class, click the [**Edit Class**] button and add or remove students as necissary. 