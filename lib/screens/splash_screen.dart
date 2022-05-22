import 'dart:async';

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:maak/res/images.dart';
import 'package:maak/screens/home_screen.dart';

import '../tt.dart';
import 'chat_screen.dart';
import 'login_screen.dart';

class SplashScreen extends StatefulWidget {
  SplashScreen({Key? key}) : super(key: key);

  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  navigate() {
    Timer(Duration(seconds: 3), () {
      Get.offAll(() => LoginScreen());
    });
  }

  @override
  void initState() {
    super.initState();
    navigate();
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      backgroundColor: Colors.white,
      body: Container(
        height: double.infinity,
        width: double.infinity,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Image.asset(
              Images.logo,
              height: size.height * 0.6,
              width: size.width * 0.9,
              fit: BoxFit.contain,
            ),
          ],
        ),
      ),
    );
  }
}
