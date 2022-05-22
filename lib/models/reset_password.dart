import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:http/http.dart';
import 'package:maak/res/app_constants.dart';

Future<dynamic> SendResetRequest(phrase) async {
  var url = "http://$ip/reset_pass_app.php";
  var localUrl = Uri.parse(url);
  Response response = await post(localUrl, body: {'email': phrase});
  var decodedData = null;
  if (response.statusCode == 200) {
    dynamic data = response.body;
    decodedData = jsonDecode(data); // the return type of this method is dynamic
    print(decodedData['data']);
    Fluttertoast.showToast(
        msg: decodedData['data'],
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
        timeInSecForIosWeb: 2,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0);
  } else {
    print('response.statusCode : ${response.statusCode}');
  }
}
