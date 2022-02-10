import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:maak/screens/splash_screen.dart';
import 'package:shared_preferences/shared_preferences.dart';

void main() {
  SharedPreferences.getInstance().then((prefs) {
    prefs.setBool("remember_me", false);
    prefs.setString('name', 'd');
    prefs.setString('password', '1');
  });
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      title: 'Maak',
      locale: Locale('ar'),
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: SplashScreen(),
    );
  }
}
