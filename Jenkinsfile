pipeline {
     agent any
     stages {
          stage('Source') {
               steps {
                    git branch: 'main',
                        url: 'https://github.com/tonypan2001/WebApp-ShabuNow.git'
               }
          }
          stage('Backend Setup') {
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
                    }
               }
          }
          stage('Frontend Setup') {
               steps {
                    dir('ShabuNow-nuxt') {
                       sh 'npm install'
                       sh 'npm run dev'
                    }
               }
          }
          stage('Deploy') {
               steps {
                    sh 'java -jar ./target/book-1.0.jar'
               }
          }
     }
}
