import firebase from '@firebase/app'
import '@firebase/database'

const config  = {
  apiKey: "AIzaSyDFTNuL38NNRgYjvddM0tgqrWprgVuoyUc",
  authDomain: "lytkiluyliulzwfqwfuk.firebaseapp.com",
  databaseURL: "https://lytkiluyliulzwfqwfuk.firebaseio.com",
  projectId: "lytkiluyliulzwfqwfuk",
  storageBucket: "lytkiluyliulzwfqwfuk.appspot.com",
  messagingSenderId: "1079794935986"
}

// คืนค่า firebase application ที่อาจถูก instantiate แล้วหรือ instantiate ใหม่
export default firebase.apps[0] || firebase.initializeApp(config)
