Install instructions
~~~~~~~~~~~~~~~~~~~~~

- Install Symfony binary
  https://symfony.com/download

- Clone the repo
  https://github.com/pirklajos/rssreader.git
  (git clone https://github.com/pirklajos/rssreader.git)

- Change dir to rssreader
  (cd rssreader)

- Run composer install
  (composer install)

- Config MySQL database connection in the .env file (located in the project root directory)

- migrate database
  (php bin/console dcotrine:migrate)

- run symfony server
  (symfony server:start)

- open project in browser as cli says (127.0.0.1:8000 usually)

RSSReader URL: /rss_reader
CRUD admin URL: /rss

default user account:
email: bence.ugrai@nki.gov.hu
password: password
