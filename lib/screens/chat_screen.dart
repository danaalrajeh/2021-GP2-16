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

void playSound(ans) {
  AudioPlayer audioPlayer = AudioPlayer();
  var base64String = base64.decode(ans);
  playLocal(base64String) {
    Uint8List byteData = base64String; // Load audio as a byte array here.
    print(byteData);
    audioPlayer.playBytes(byteData);
  }

  playLocal(base64String);
}

class AudioRecognize extends StatefulWidget {
  var row;
  AudioRecognize(this.row);

  @override
  State<StatefulWidget> createState() => _AudioRecognizeState(row);
}

class _AudioRecognizeState extends State<AudioRecognize> {
  var id;
  final RecorderStream _recorder = RecorderStream();
  bool recognizing = false;
  bool recognizeFinished = false;
  String text = '';
  late StreamSubscription<List<int>> _audioStreamSubscription;
  late BehaviorSubject<List<int>> _audioStream;

  _AudioRecognizeState(this.id);

  @override
  void initState() {
    super.initState();

    _recorder.initialize();
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

    var responseText = '';

    responseStream.listen((data) async {
      final currentText =
          data.results.map((e) => e.alternatives.first.transcript).join('\n');

      if (data.results.first.isFinal) {
        responseText += '\n' + currentText;

        var greeting = 'السلام عليكم.';
        var med_name = <String>[
          "ما اسم الدواء؟",
          "ما اسم العلاج؟",
          "الدواء.",
          "العلاج.",
          "اش اسم الدواء؟",
          "اش اسم العلاج؟"
        ];

        var dose = <String>[
          "كم حبة اخذ؟",
          "كم حبه اخذ؟",
          "كم مل اخذ؟",
          "الجرعة؟",
          "ما الجرعة؟",
          "اش الجرعة.",
          "كم الجرعة.",
          "ما الجرعة اليوم؟"
        ];
        var med_time = <String>[
          "متى اخذ الدواء؟",
          "متى اخذ العلاج؟",
          "موعد الدواء.",
          "موعد العلاج."
        ];
        var precaution = <String>[
          "ما الاحتياطات الواجبة؟",
          "ما الاحتياطات الواجبه؟",
          "اش لازم اخذ حذري منه؟",
          "حذر.",
          "موانع.",
          "مانع.",
          "الاحتياطات."
        ];
        var appointment = <String>[
          "متى موعدي؟",
          "متى موعدي؟",
          "متى اشوف الدكتور؟",
          "موعد.",
          "موعدي.",
          "موعدى.",
          "الساعة كام موعدي؟",
          "الساعة كام موعدى؟",
          "متى ازور الدكتور؟",
          "متى ازور الطبيب؟",
          "متى ازور المستشفى؟",
          "متى اروح المستشفى؟",
          "متى اروح للطبيب؟",
          "متى اروح للدكتور؟",
          "الطبيب.",
          "المستشفى.",
          "الدكتور.",
          "وقت."
        ];

        if (currentText.contains(greeting)) {
          NetworkHelper helper =
              new NetworkHelper('و عليكم السلام'); //text to speech api
          dynamic voice_speech = await helper.getData();
          setState(() {
            text = responseText + '\n' + 'و عليكم السلام';
            recognizeFinished = true;
            playSound(voice_speech);
          });
        } else if (med_name.contains(currentText)) {
          Search medic = new Search('medication', 'prescription',
              id); //search database for medication name
          dynamic medicName = await medic.search();
          NetworkHelper helper = new NetworkHelper(medicName['medication']);
          dynamic voice_speech = await helper.getData();
          setState(() {
            text = responseText + '\n' + medicName['medication'];
            recognizeFinished = true;
            playSound(voice_speech);
          });
        } else if (dose.contains(currentText)) {
          Search medic = new Search(
              'dose', 'prescription', id); //search database for medication name
          dynamic medicName = await medic.search();
          NetworkHelper helper = new NetworkHelper(medicName['dose']);
          dynamic voice_speech = await helper.getData();
          setState(() {
            text = responseText + '\n' + medicName['dose'];
            recognizeFinished = true;
            playSound(voice_speech);
          });
        } else if (med_time.contains(currentText)) {
          Search medic = new Search(
              'time', 'prescription', id); //search database for medication name
          dynamic medicName = await medic.search();
          NetworkHelper helper = new NetworkHelper(medicName['time']);
          dynamic voice_speech = await helper.getData();
          setState(() {
            text = responseText + '\n' + medicName['time'];
            recognizeFinished = true;
            playSound(voice_speech);
          });
        } else if (precaution.contains(currentText)) {
          Search medic = new Search('precautions', 'prescription',
              id); //search database for medication name
          dynamic medicName = await medic.search();
          NetworkHelper helper = new NetworkHelper(medicName['precautions']);
          dynamic voice_speech = await helper.getData();
          setState(() {
            text = responseText + '\n' + medicName['precautions'];
            recognizeFinished = true;
            playSound(voice_speech);
          });
        } else if (appointment.contains(currentText)) {
          Search medic = new Search("`a_date`,`a_time`", 'appointment',
              id); //search database for medication name
          dynamic medicName = await medic.search();
          var medicTime = medicName['a_time'];
          var medicDate = medicName['a_date'];
          var respond_phrase = "الموعد يوم $medicDate الساعة $medicTime";
          NetworkHelper helper = new NetworkHelper(respond_phrase);
          dynamic voice_speech = await helper.getData();
          setState(() {
            text = responseText + '\n' + respond_phrase;
            recognizeFinished = true;
            playSound(voice_speech);
          });
        } else {
          /*NetworkHelper helper = new NetworkHelper('لم أفهم ما تقول');
          dynamic voice_speech = await helper.getData();
          setState(() {
            text = responseText + '\n' + 'لم أفهم ما تقول';
            recognizeFinished = true;
            playSound(voice_speech);
        });*/
        }
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
                if (recognizeFinished)
                  _RecognizeContent(
                    text: text,
                  ),
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

@override
Widget build(BuildContext context) {
  // TODO: implement build
  throw UnimplementedError();
}
