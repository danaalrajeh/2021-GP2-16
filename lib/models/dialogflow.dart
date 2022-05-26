import 'dart:async';
import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_appauth/flutter_appauth.dart';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:intl/intl.dart';
import 'package:maak/models/tts.dart';
import 'package:maak/models/urgent.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:maak/models/notification.dart';

dynamic authorizationEndpoint = '';
dynamic tokenEndpoint = '';
var identifier = '';
final credentialsFile = File('~/.myapp/credentials.json');
var redirectUrl =
    'client id'; // redirectURl in the case of mobile app is the clientID inverted + :/oauth2redirect
var id;

Future<void> readJson(var text, var tid) async {
  //read json file to connect with google api then run getToken function
  id = tid;
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
  // get token for oauth2.0 connection and send the request
  final DateTime now = DateTime.now();
  final DateFormat formatter = DateFormat('Md');
  final String formatted = formatter.format(now);
  final String md = formatted.replaceAll("/", '');
  print(md);
  var session_id = md + '7' + 'maak' + id.toString() + 'star';
  final prefs = await SharedPreferences.getInstance();
  String? token = prefs.getString('token');
  String? refresh_token = prefs.getString('refresh_token');
  if (token == null || refresh_token == null) {
    FlutterAppAuth appAuth = FlutterAppAuth(); //connect with oauth server
    final AuthorizationTokenResponse? result =
        await appAuth.authorizeAndExchangeCode(
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
    token = result?.accessToken;
    String? _refreshtoken = result?.refreshToken;
    await prefs.setString('token', token.toString());
    await prefs.setString('refresh_token', _refreshtoken.toString());
  }

  Future<void> refresh(var text) async {
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
      getToken(text);
    } catch (e) {
      print(e);
    }
  }

// request sent to dialogflow
  var body =
      '{"queryInput": {"text": {"text": "$text"}, "languageCode": "ar"}}';

  final http.Response httpResponse = await http.post(
      Uri.parse(
          'https://global-dialogflow.googleapis.com/v3/projectID/locations/global/agents/agentID/sessions/$session_id:detectIntent'),
      headers: <String, String>{
        'Authorization': 'Bearer $token'
      }, //autharization
      body: body);
  print(httpResponse.body);
  if (httpResponse.statusCode == 200) {
    var res = jsonDecode(httpResponse.body);
    var the_result =
        res['queryResult']["responseMessages"][0]['text']['text'][0];
    print(the_result);
    var t = res['queryResult']["responseMessages"];
    if (t.length == 2) {
      if (res['queryResult']["responseMessages"][1]['text']['text'][0] ==
              'كيف تشعر اليوم؟' ||
          res['queryResult']["responseMessages"][1]['text']['text'][0] ==
              'كيف حالك اليوم؟') {
        var ques = res['queryResult']["responseMessages"][1]['text']['text'][0];
        var obj = TTS(); //create object from tts
        obj.call(the_result);
        Timer(Duration(seconds: 3), () {
          obj.call(ques);
        });
      }
    } else if (the_result.contains('critical')) {
      print(res['queryResult']['text']);
      Urgent(res['queryResult']['text'], id);
    } else if (the_result.contains('notification')) {
      notifcation(request: 'test');
    } else {
      var obj = TTS();
      obj.call(the_result);
    }
  } else if (httpResponse.statusCode == 401) {
    refresh(text);
  }
  print(httpResponse.statusCode);
}
