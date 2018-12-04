# dating-webapp
## capstone project

### files included:
  #### friends-directory.php
  displays all members currently on site. built for testing purposes
  #### friends-list.php
  displays friends list
  #### home.php
  home page with links to all other php pages
  #### index.php
  login wrapper that either logs user in or redirects user back to login screen
  #### invitations.php
  handles invitations to watch YouTube videos with a friend
  #### load.php
  helper to include includes/ files
  #### login.php
  user login form, handled by class-login.php
  #### messages.php
  fully functional chat room with links to send video invitations and to go to youtube.php
  #### messages-compose.php
  php page that helped influence messages.php. also still used to compose a message
  #### messages-inbox.php
  php page that helped influence messages.php
  #### profile-edit.php
  allows users to view profile information
  #### profile-view.php
  allows users to edit profile information
  #### register.php
  user registration form, handled by class-login.php
  #### server.php
  file originally used to make contact with database and to handle login and registration.
  ss still included for future reference if needed.
  #### youtube.php
  holds YouTube search, YouTube iframe and messages container. Allows users to chat while watching a YouTube video
  #### youtube-handler.php
  redirects user to page containing youtube video if neccessary
  
### folders included:
  #### css folder
  contains css files used throughout site
  #### images folder
  contains various images used throughout site
  #### includes folder
  ##### class-db.php
  makes connection to database and is called by class-insert and class-query to contact database
  ##### class-insert.php
  contains functions used to send itmes to database tables
  ##### class-login.php
  contains functions used to handle the login and registration system
  ##### class-query.php
  contains functions used to retrieve database table items 
  ##### header.php
  contains navigation bar used on each php page
  ##### messages-container.php
  holds messages container; will possibly be used in the future
  #### login and register bootstrap folders
  contains bootstrap css and javascript used on login and registration forms
