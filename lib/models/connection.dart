import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:get/get_core/src/get_main.dart';
import 'package:get/get_navigation/src/extension_navigation.dart';
import 'package:maak/models/networking.dart';
import 'package:maak/res/app_constants.dart';
import 'package:maak/screens/chat_screen.dart';
import 'package:mysql1/mysql1.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'notification.dart';

Future db_conn(name, pass, rem) async {
  //login process
  // Open a connection
  final conn = await MySqlConnection.connect(ConnectionSettings(
      host: ip, //found in res/app_constant.dart
      port: 3306,
      user: '',
      db: '',
      password: ''));

  // Query the database using a parameterized query
  try {
    print('new');
    var results =
        await conn.query('select * from patients where username = ?', [name]);
    if (results.length >= 1) {
      for (var row in results) {
        if (pass.toString() == row["password"]) {
          if (rem) {
            SharedPreferences.getInstance().then(
              (prefs) {
                prefs.setBool("remember_me", rem);
                prefs.setString('name', name);
                prefs.setString('password', pass.toString());
              },
            );
          }
          Get.to(() => AudioRecognize(row['id']))
              ?.whenComplete(() => startnoti(row['id']));
        } else {
          Fluttertoast.showToast(
              // response if password is wrong
              msg: "اسم المستخدم او كلمة المرور خاطئة",
              toastLength: Toast.LENGTH_SHORT,
              gravity: ToastGravity.CENTER,
              timeInSecForIosWeb: 1,
              backgroundColor: Colors.red,
              textColor: Colors.white,
              fontSize: 16.0);
        }
      }
    } else {
      Fluttertoast.showToast(
          // response if email is wrong
          msg: "اسم المستخدم او كلمة المرور خاطئة",
          toastLength: Toast.LENGTH_SHORT,
          gravity: ToastGravity.CENTER,
          timeInSecForIosWeb: 1,
          backgroundColor: Colors.red,
          textColor: Colors.white,
          fontSize: 16.0);
    }
  } on Exception catch (e) {
    print(e); //debugging
  }

  // Finally, close the connection
  await conn.close();
}

class Search {
  var req;
  var table;
  var id;
  Search(this.req, this.table, this.id);
  Future search() async {
    var result = null;
    // Open a connection (testdb should already exist)
    final conn = await MySqlConnection.connect(ConnectionSettings(
        host: ip, port: 3306, user: '', db: '', password: ''));

    // Query the database using a parameterized query
    var results =
        await conn.query('select $req from $table where p_id = ?', [id]);
    if (results.length == 1) {
      for (var row in results) {
        result = row[req];
        return result;
      }
    } else if (results.length > 1) {
      result = '';
      for (var row in results) {
        result += row[req] + ',';
      }
    }
    await conn.close();
    return result;
  }
}

class Search_app {
  var req;
  var table;
  var id;
  Search_app(this.req, this.table, this.id);
  Future search() async {
    var result = null;
    // Open a connection (testdb should already exist)
    final conn = await MySqlConnection.connect(ConnectionSettings(
        host: ip, port: 3306, user: '', db: '', password: ''));

    // Query the database using a parameterized query
    var results =
        await conn.query('select $req from $table where p_id = ?', [id]);
    if (results.length == 1) {
      for (var row in results) {
        var medicDate = row['a_date'];
        var medicTime = row['a_time'];
        result = "الموعد يوم $medicDate الساعة $medicTime";
        return result;
      }
    } else if (results.length > 1) {
      result = '';
      for (var row in results) {
        var medicDate = row['a_date'];
        var medicTime = row['a_time'];
        result += "الموعد يوم $medicDate الساعة $medicTime" + ',';
      }
    }
    await conn.close();
    return result;
  }
}

class User_data {
  var req;
  var table;
  var id;
  User_data(this.req, this.table, this.id);
  Future search() async {
    var result = null;
    // Open a connection (testdb should already exist)
    final conn = await MySqlConnection.connect(ConnectionSettings(
        host: ip, port: 3306, user: '', db: '', password: ''));

    // Query the database using a parameterized query
    var results =
        await conn.query('select $req from $table where id = ?', [id]);

    if (results.length == 1) {
      return results;
    }
    await conn.close();
    return result;
  }
}
