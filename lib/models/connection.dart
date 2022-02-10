import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:get/get_core/src/get_main.dart';
import 'package:get/get_navigation/src/extension_navigation.dart';
import 'package:maak/screens/chat_screen.dart';
import 'package:mysql1/mysql1.dart';
import 'package:shared_preferences/shared_preferences.dart';

Future db_conn(name, pass, rem) async {
  // Open a connection (testdb should already exist)
  final conn = await MySqlConnection.connect(ConnectionSettings(
      host: '10.6.197.79',
      port: 3306,
      user: 'root',
      db: 'clinic',
      password: 'dana1234'));

  // Query the database using a parameterized query
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
        Get.to(() => AudioRecognize(row['id']));
      } else {
        Fluttertoast.showToast(
            msg: "wrong credentials",
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
        msg: "wrong credentials",
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.CENTER,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.red,
        textColor: Colors.white,
        fontSize: 16.0);
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
        host: '10.6.197.79',
        port: 3306,
        user: 'root',
        db: 'clinic',
        password: 'dana1234'));

    // Query the database using a parameterized query
    var results =
        await conn.query('select $req from $table where p_id = ?', [id]);
    if (results.length >= 1) {
      for (var row in results) {
        result = row;
      }
    }
    await conn.close();
    return result;
  }
}
