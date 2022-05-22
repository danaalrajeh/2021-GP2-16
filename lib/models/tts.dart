

import '../screens/chat_screen.dart';
import 'networking.dart';

class TTS {



  Future call(var data) async{
    NetworkHelper helper = new NetworkHelper(data);
    dynamic voice_speech = await helper.getData();
    wait(data);
    playSound(voice_speech);

  }
}