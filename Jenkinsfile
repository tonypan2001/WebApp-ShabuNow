pipeline {
     agent any
     stages {
          stage('Source') {
               steps {
                    git branch: 'main',
                        url: 'https://github.com/tonypan2001/WebApp-ShabuNow.git'
               }
          }
          
          
          stage('Frontend Setup') {
               steps {
                    dir('ShabuNow-nuxt') {
                       sh 'npm install'                
                    }
               }
          }
          stage('Deploy') {
               steps {
                    dir('ShabuNow-nuxt') {                     
                       sh 'npm run dev'
                    }
               }
          }
     }
}
