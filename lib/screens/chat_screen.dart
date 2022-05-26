import 'dart:async';
import 'dart:convert';
import 'dart:typed_data';

import 'package:flutter/material.dart';
import 'package:maak/models/connection.dart';
import 'package:maak/models/networking.dart';
import 'package:maak/res/app_constants.dart';
import 'package:maak/widgets/drawer_widget.dart';
import 'package:flutter/services.dart';
import 'package:google_speech/google_speech.dart';
import 'package:rxdart/rxdart.dart';
import 'package:sound_stream/sound_stream.dart';
import 'package:audioplayers/audioplayers.dart';
import 'package:string_similarity/string_similarity.dart';

import '../models/dialogflow.dart';
import '../models/urgent.dart';

void playSound(ans) {
  //text to speech
  AudioPlayer audioPlayer = AudioPlayer();
  var base64String = base64.decode(ans);
  playLocal(base64String) {
    Uint8List byteData = base64String; // Load audio as a byte array here.
    print(byteData);
    audioPlayer.playBytes(byteData);
  }

  playLocal(base64String);
}

String dr = '';

class AudioRecognize extends StatefulWidget {
  var row;
  AudioRecognize(this.row);

  @override
  State<StatefulWidget> createState() => AudioRecognizeState(row);
}

class AudioRecognizeState extends State<AudioRecognize> {
  var id;
  final RecorderStream _recorder = RecorderStream();
  bool recognizing = false;
  bool recognizeFinished = false;
  String? text;

  late StreamSubscription<List<int>> _audioStreamSubscription;
  late BehaviorSubject<List<int>> _audioStream;
  var responseText;

  AudioRecognizeState(this.id);

  @override
  void initState() {
    super.initState();

    _recorder.initialize();
    var _now = DateTime.now().second.toString();

    // defines a timer
    var _everySecond = Timer.periodic(Duration(seconds: 1), (Timer t) {
      setState(() {
        _now = DateTime.now().second.toString();
      });
    });
  }

  void streamingRecognize() async {
    _audioStream = BehaviorSubject<List<int>>();
    _audioStreamSubscription = _recorder.audioStream.listen((event) {
      _audioStream.add(event);
    });

    await _recorder.start();

    setState(() {
      recognizing = true;
    });
    final serviceAccount = ServiceAccount.fromString(
        '${(await rootBundle.loadString('assets/test_service_account.json'))}');
    final speechToText = SpeechToText.viaServiceAccount(serviceAccount);
    final config = _getConfig();

    final responseStream = speechToText.streamingRecognize(
        StreamingRecognitionConfig(config: config, interimResults: true),
        _audioStream);

    responseText = '';

    responseStream.listen((data) async {
      final currentText =
          data.results.map((e) => e.alternatives.first.transcript).join('\n');

      if (data.results.first.isFinal) {
        responseText += '\n' + currentText;
        readJson(currentText, id);
      } else {
        setState(() {
          text = responseText + '\n' + currentText;
          recognizeFinished = true;
        });
      }
    }, onDone: () {
      setState(() {
        recognizing = false;
      });
    });
  }

  void stopRecording() async {
    await _recorder.stop();
    await _audioStreamSubscription?.cancel();
    await _audioStream?.close();
    setState(() {
      recognizing = false;
    });
  }

  RecognitionConfig _getConfig() => RecognitionConfig(
      encoding: AudioEncoding.LINEAR16,
      model: RecognitionModel.basic,
      enableAutomaticPunctuation: true,
      sampleRateHertz: 16000,
      languageCode: 'ar-SA');

  final GlobalKey<ScaffoldState> _key = GlobalKey();
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      key: _key,
      drawer: DrawerWidget(),
      backgroundColor: Colors.white,
      body: Container(
        width: size.width,
        height: size.height,
        margin: EdgeInsets.symmetric(horizontal: 20),
        child: Column(
          children: [
            SizedBox(
              height: 40,
            ),
            Row(
              children: [
                // IconButton(
                //   onPressed: () {},
                //   icon: Icon(
                //     Icons.menu_rounded,
                //     size: 40,
                //     color: Colors.transparent,
                //   ),
                // ),
                IconButton(
                  onPressed: () {
                    _key.currentState!.openDrawer();
                  },
                  icon: Icon(
                    Icons.menu_rounded,
                    size: 40,
                  ),
                ),
                Spacer(),
                Text(
                  'معك',
                  style: TextStyle(
                    fontSize: 30,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Spacer(),
                SizedBox(
                  width: 50,
                ),
              ],
            ),
            Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: <Widget>[
                if (recognizeFinished) ...[
                  _RecognizeContent(
                    text: text.toString(),
                  ),
                  _Rt(dr: dr)
                ]
              ],
            ),
            Spacer(),
            Container(
              child: Column(
                children: [
                  Align(
                    alignment: Alignment.bottomCenter,
                    child: Container(
                      width: size.width * 0.2,
                      height: size.height * 0.1,
                      decoration: BoxDecoration(
                        color: AppConstants.primaryColor!.withOpacity(0.6),
                        shape: BoxShape.circle,
                        boxShadow: [
                          BoxShadow(
                            color: Colors.grey.withOpacity(0.5),
                            spreadRadius: 3,
                            blurRadius: 4,
                            offset: Offset(0, 0), // changes position of shadow
                          ),
                        ],
                      ),
                      child: ElevatedButton(
                        style:
                            ElevatedButton.styleFrom(primary: Colors.pink[400]),
                        onPressed:
                            recognizing ? stopRecording : streamingRecognize,
                        child: recognizing
                            ? Icon(
                                Icons.mic_none,
                                color: Colors.black,
                                size: 30,
                              )
                            : Icon(
                                Icons.mic,
                                color: Colors.black,
                                size: 30,
                              ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
            SizedBox(
              height: 30,
            ),
          ],
        ),
      ),
    );
  }
}

class _RecognizeContent extends StatelessWidget {
  final String text;

  const _RecognizeContent({Key? key, required this.text}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          SizedBox(
            height: 16.0,
          ),
          Text(
            text,
            style: Theme.of(context).textTheme.bodyText1,
          ),
        ],
      ),
    );
  }
}

wait(dro) {
  dr = dro;
  print(dro);
}

class _Rt extends StatelessWidget {
  final String dr;

  const _Rt({Key? key, required this.dr}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          SizedBox(
            height: 16.0,
          ),
          Text(
            dr,
            style: Theme.of(context).textTheme.bodyText1,
          ),
        ],
      ),
    );
  }
}

@override
Widget build(BuildContext context) {
  // TODO: implement build
  throw UnimplementedError();
}
