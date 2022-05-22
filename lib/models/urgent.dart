import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:http/http.dart';
import 'package:maak/res/app_constants.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:whatsapp_unilink/whatsapp_unilink.dart';

import 'connection.dart';

Future<dynamic> Urgent(phrase,id) async {
  User_data user = new User_data("`fname`,`relative_name`,`relative_phone`,`physician_id`",'patients',id);
  dynamic respond = await user.search();
  for(var res in respond){
    var patient_name = res['fname'];
    var relative_name = res['relative_name'];
    var relative_phone = res['relative_phone'];
    var physician_id = res['physician_id'];
    print(patient_name);
    print(relative_name);
    print(relative_phone);
    print(physician_id);
    if(physician_id != null){
      User_data doctor = new User_data("`fname`,`email`",'users',physician_id);
      if(phrase.contains('نعم')){
        phrase = 'احتاج لمساعدة طبية';
      }
      dynamic result = await doctor.search();
      for(var dres in result){
      var doc_name = dres['fname'];
      var doc_email = dres['email'];
      print(doc_name);

      var url = "http://$ip/urgent.php";
      var localUrl = Uri.parse(url);
      Response response = await post(localUrl,body: {'patient_name': patient_name,'doc_name': doc_name,'doc_email': doc_email, 'condition': phrase});

      if (response.statusCode == 200) {
        print('response.statusCode : ${response.statusCode}');

      } else {
        print('response.statusCode : ${response.statusCode}');
      }
      }
    }
    if(relative_name != null){
      launchWhatsApp() async {
        print('inside launch');
        final link = WhatsAppUnilink(
          phoneNumber: relative_phone.toString(),
          text: "اهلا $relative_name $phrase",
        );
        await launch('$link').then((value) => print('done whats'));
      }
      launchWhatsApp();
    }
  }
}
