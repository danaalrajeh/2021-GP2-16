import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_appauth/flutter_appauth.dart';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:intl/intl.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:maak/models/notification.dart';

import 'models/dialogflow.dart';



dynamic authorizationEndpoint = '';
dynamic tokenEndpoint = '';
var identifier = '';
final credentialsFile = File('~/.myapp/credentials.json');
var redirectUrl = 'com.googleusercontent.apps.292002520319-8aqrl9ru6tijeqeuhruqfbujan4d5jre:/oauth2redirect'; // redirectURl in the case of mobile app is the clientID inverted + :/oauth2redirect
var _accessToken;

Future<void> eadJson(var text) async {

  final String response = await rootBundle.loadString('assets/client.json');
  final data = await json.decode(response);
  authorizationEndpoint = data['installed']['auth_uri'];
  print(authorizationEndpoint);
  tokenEndpoint = data['installed']['token_uri'];
  print(tokenEndpoint);
  identifier = data['installed']['client_id'];
  print(identifier);
  getToken(text);
  // fetchFiles();
}
Future<void> getToken(var text) async {
  final prefs = await SharedPreferences.getInstance();
  String? token = prefs.getString('token');
  String? refresh_token = prefs.getString('refresh_token');
  if(token == null || refresh_token == null) {
    FlutterAppAuth appAuth = FlutterAppAuth();
    final AuthorizationTokenResponse? result = await appAuth
        .authorizeAndExchangeCode(
      AuthorizationTokenRequest(
        identifier,
        redirectUrl,
        serviceConfiguration: AuthorizationServiceConfiguration(
            authorizationEndpoint: authorizationEndpoint,
            tokenEndpoint: tokenEndpoint),
        scopes: [
          'https://www.googleapis.com/auth/cloud-platform',
          'https://www.googleapis.com/auth/dialogflow'
        ],
      ),
    );

    print(result?.accessToken);
    print(result?.refreshToken);
    _accessToken = result?.accessToken;
    String? _refreshtoken = result?.refreshToken;
    await prefs.setString('token', _accessToken.toString());
    await prefs.setString('refresh_token', _refreshtoken.toString());
  }

  Future<void> refresh() async {
    FlutterAppAuth appAuth = FlutterAppAuth();
    try {
      print(token);
      print(refresh_token);
      final TokenResponse? result = await appAuth.token(TokenRequest(
          identifier, redirectUrl,
          refreshToken: refresh_token,
          serviceConfiguration: AuthorizationServiceConfiguration(
              authorizationEndpoint: authorizationEndpoint,
              tokenEndpoint: tokenEndpoint),
          scopes: [
            'https://www.googleapis.com/auth/cloud-platform',
            'https://www.googleapis.com/auth/dialogflow'
          ]));
      print(result?.accessToken);
      await prefs.setString('token', (result?.accessToken).toString());
    } catch (e) {
      print(e);
    }
  }
    var body =
        '{"queryInput": {"text": {"text": "$text"}, "languageCode": "ar"}}';

    final http.Response httpResponse = await http.post(
        Uri.parse(
            'https://global-dialogflow.googleapis.com/v3/projects/bionic-flux-342309/locations/global/agents/f60ed910-e418-4d61-9095-785d300a3972/sessions/1235:detectIntent'),
        headers: <String, String>{'Authorization': 'Bearer $_accessToken'},
        body: body);
    print(httpResponse.body);
    if (httpResponse.statusCode == 200) {
      var res = jsonDecode(httpResponse.body);
      print(res['queryResult']['text']['text']);
      print('hii');
    } else if (httpResponse.statusCode == 401) {
      refresh();
    }
    print(httpResponse.statusCode);
}

class Doc_ai extends StatefulWidget {

  static String id = 'doc_ai';

  @override
  _Doc_aiState createState() => _Doc_aiState();
}

class _Doc_aiState extends State<Doc_ai> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        child: Center(
          child: FlatButton(
            child: Text('test'),
            onPressed: (){
              try {
                readJson('اسم الدواء',11);
                // notifcation(request: 'test');
              } on Exception catch (e) {
                print(e);
              }
              // readJson('السلام عليکم');
            },
          ),
        ),
      ),
    );
  }
}

