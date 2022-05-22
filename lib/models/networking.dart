import 'dart:convert';

import 'package:http/http.dart';

class NetworkHelper {
  var url = "https://texttospeech.googleapis.com/v1beta1/text:synthesize?key=AIzaSyCMjFhANpscW64_FxcitkJQtG52jB-UwpI";
  var phrase;

  NetworkHelper(this.phrase);

  Future<dynamic> getData() async {
    var localUrl = Uri.parse(url);
    var body = {
      "audioConfig": {
    "audioEncoding": "LINEAR16",
    "pitch": 0,
    "speakingRate": 1
  },
  "input": {
    "text": "$phrase"
  },
  "voice": {
    "languageCode": "ar-XA",
    "name": "ar-XA-Wavenet-A"
  }
};
    var bodyString = jsonEncode(body);
    Response response = await post(localUrl,body: bodyString);
    var decodedData = null;
    if (response.statusCode == 200) {
      var data = response.body;
      decodedData = jsonDecode(data); // the return type of this method is dynamic
    } else {
      print('response.statusCode : ${response.statusCode}');
    }
    return decodedData['audioContent'];
  }
}
