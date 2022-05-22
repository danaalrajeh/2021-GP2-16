import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:get/get_core/src/get_main.dart';
import 'package:maak/models/connection.dart';
import 'package:maak/res/images.dart';
import 'package:maak/widgets/button_main_widget.dart';
import 'package:crypto/crypto.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import 'dart:async';

import '../models/notification.dart';
import 'forget_screen.dart';

class LoginScreen extends StatefulWidget {
  LoginScreen({Key? key}) : super(key: key);

  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  bool _remember = false;
  TextEditingController _nameController = TextEditingController();
  TextEditingController _passController = TextEditingController();

  checkrem() async {
    var prefs = await SharedPreferences.getInstance();
    var check_rem = prefs.getBool('remember_me');
    var check_user = prefs.getString('name');
    var check_password = prefs.getString('password');
    if (check_rem == true) {
      if (check_user != null && check_password != null) {
        db_conn(check_user, check_password, check_rem);
      }
    }
  }

  @override
  void initState() {
    checkrem();
  }

  final _formState = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      backgroundColor: Colors.white,
      body: Container(
        height: size.height,
        width: size.width,
        child: SingleChildScrollView(
          child: Form(
            key: _formState,
            child: Column(
              children: [
                SizedBox(
                  height: 20,
                ),
                Align(
                  alignment: Alignment.topRight,
                  child: Image.asset(
                    Images.logo,
                    height: size.height * 0.2,
                    width: size.width * 0.3,
                    fit: BoxFit.contain,
                  ),
                ),
                SizedBox(
                  height: 30,
                ),
                Text(
                  'تسجيل الدخول',
                  style: TextStyle(
                    fontSize: 30,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                SizedBox(
                  height: 20,
                ),
                Container(
                  margin: EdgeInsets.symmetric(horizontal: 40, vertical: 20),
                  decoration: BoxDecoration(
                    color: Colors.blueGrey[100],
                    borderRadius: BorderRadius.circular(15),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: TextFormField(
                      controller: _nameController,
                      decoration: InputDecoration(
                        hintText: 'اسم المستخدم',
                        border: InputBorder.none,
                        errorBorder: InputBorder.none,
                        enabledBorder: InputBorder.none,
                        focusedBorder: InputBorder.none,
                        disabledBorder: InputBorder.none,
                        focusedErrorBorder: InputBorder.none,
                      ),
                    ),
                  ),
                ),
                Container(
                  margin: EdgeInsets.symmetric(horizontal: 40, vertical: 20),
                  decoration: BoxDecoration(
                    color: Colors.blueGrey[100],
                    borderRadius: BorderRadius.circular(15),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: TextFormField(
                      controller: _passController,
                      obscureText: true,
                      decoration: InputDecoration(
                        hintText: 'الرقم السري',
                        border: InputBorder.none,
                        errorBorder: InputBorder.none,
                        enabledBorder: InputBorder.none,
                        focusedBorder: InputBorder.none,
                        disabledBorder: InputBorder.none,
                        focusedErrorBorder: InputBorder.none,
                      ),
                    ),
                  ),
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      "تذكرني",
                      style: TextStyle(color: Colors.blueGrey[100]),
                    ),
                    Checkbox(
                        value: _remember,
                        onChanged: (value) {
                          _remember = !_remember;
                          setState(() {});
                        })
                  ],
                ),
                SizedBox(
                  height: 30,
                ),
                ButtonMainWidget(
                    title: 'دخول',
                    onTap: () {
                      db_conn(
                          _nameController.text,
                          md5.convert(utf8.encode(_passController.text)),
                          _remember);
                      //Get.to(() => AudioRecognize());
                    },
                    size: size),
                Padding(
                  padding: const EdgeInsets.all(10),
                  child: Center(
                    child: RichText(
                        text: TextSpan(
                      text: 'نسيت كلمة المرور؟',
                      style: TextStyle(
                          fontSize: 18,
                          color: Colors.black,
                          decoration: TextDecoration.underline),
                      recognizer: TapGestureRecognizer()
                        ..onTap = () => Get.offAll(() => ForgetScreen()),
                    )),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
