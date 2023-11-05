pipeline {
     agent any
     stages {
          stage('Source') {
               steps {
                    git branch: 'main',
                        url: 'https://github.com/tonypan2001/WebApp-ShabuNow.git'
               }
          }
          stage('Build') {
               steps {
                    dir('ShabuNow') {
                        sh 'docker run --rm \
                        -u "$(id -u):$(id -g)" \
                        -v "$(pwd):/var/www/html" \
                        -w /var/www/html \
                        laravelsail/php82-composer:latest \
                        composer install --ignore-platform-reqs'
                        sh 'cp .env.example .env'
                         sh 'vendor/bin/sail down'
                        sh 'vendor/bin/sail up -d'
                        sh 'vendor/bin/sail yarn install'
                        sh 'vendor/bin/sail yarn dev'
                    }
               }
          }
          stage('Test') {
               steps {
                    echo 'testing...'
                    //sh 'mvn test'
               }
          }
          stage('Deploy') {
               steps {
                    sh 'java -jar ./target/book-1.0.jar'
               }
          }
     }
}
