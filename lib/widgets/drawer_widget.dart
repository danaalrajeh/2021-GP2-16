import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:maak/res/app_constants.dart';
import 'package:maak/screens/home_screen.dart';
import 'package:shared_preferences/shared_preferences.dart';

class DrawerWidget extends StatelessWidget {
  const DrawerWidget({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Column(
        children: [
          SizedBox(height: 40),
          GestureDetector(
            onTap: () {
              SharedPreferences.getInstance().then(
                (prefs) {
                    prefs.setBool("remember_me", false);});
              Get.offAll(() => HomeScreen());
            },
            child: Container(
              decoration: BoxDecoration(
                color: Colors.pink[400],
                borderRadius: BorderRadius.circular(15),
                boxShadow: [
                  BoxShadow(
                    color: Colors.grey.withOpacity(0.5),
                    spreadRadius: 3,
                    blurRadius: 4,
                    offset: Offset(0, 3), // changes position of shadow
                  ),
                ],
              ),
              child: Padding(
                padding: const EdgeInsets.all(10),
                child: Text(
                  'تسجيل الخروج',
                  style: AppConstants.buttonStyle,
                ),
              ),
            ),
          ),
          Spacer(),
          Text(
            'معك',
            style: TextStyle(
              fontSize: 30,
              fontWeight: FontWeight.bold,
            ),
          ),
          Spacer(),
          SizedBox(height: 80),
        ],
      ),
    );
  }
}
