import '../screens/chat_screen.dart';
import 'networking.dart';

class TTS {
  //sent the response to the text to speech api and redirect the result to be shown on the screen and get played the sound

  Future call(var data) async {
    NetworkHelper helper = new NetworkHelper(data);
    dynamic voice_speech = await helper.getData();
    wait(data);
    playSound(voice_speech);
  }
}
