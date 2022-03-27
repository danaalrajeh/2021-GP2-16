import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:http/http.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:whatsapp_unilink/whatsapp_unilink.dart';

import 'connection.dart';

Future<dynamic> Urgent(phrase,id) async {
  User_data user = new User_data("`fname`,`relative_name`,`relative_phone`,`physician_id`",'patients',id);
  dynamic respond = await user.search();
  var patient_name = respond['fname'];
  var relative_name = respond['relative_name'];
  var relative_phone = respond['relative_phone'];
  var physician_id = respond['physician_id'];
  if(physician_id != null){
    User_data doctor = new User_data("`fname`,`email`",'users',physician_id);
    dynamic result = await doctor.search();
    var doc_name = result['fname'];
    var doc_email = result['email'];

    var url = "http://192.168.1.7/Gp1s1/urgent.php";
    var localUrl = Uri.parse(url);
    Response response = await post(localUrl,body: {'patient_name': patient_name,'doc_name': doc_name,'doc_email': doc_email, 'condition': phrase});
    var decodedData = null;
    if (response.statusCode == 200) {
      dynamic data = response.body;
      decodedData = jsonDecode(data); // the return type of this method is dynamic
      print(decodedData['data']);
    } else {
      print('response.statusCode : ${response.statusCode}');
    }
  }
  if(relative_name != null){
    launchWhatsApp() async {
      final link = WhatsAppUnilink(
        phoneNumber: relative_phone,
        text: "اهلا $relative_name اشعر ب$phrase",
      );
      await launch('$link');
    }
    launchWhatsApp();
  }
}
