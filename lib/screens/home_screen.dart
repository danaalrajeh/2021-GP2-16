import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:maak/models/connection.dart';
import 'package:maak/res/images.dart';
import 'package:maak/screens/login_screen.dart';
import 'package:maak/widgets/button_main_widget.dart';
import 'package:shared_preferences/shared_preferences.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({Key? key}) : super(key: key);

  Future check() async{
    SharedPreferences prefs = await SharedPreferences.getInstance();
    var remember_store = prefs.getBool('remember_me')!;
    var name_store = prefs.getString('name');
    var pass_store = prefs.getString('password');

    if(remember_store){
      db_conn(name_store,pass_store,remember_store);
    }else{
      Get.offAll(() => LoginScreen());
    }
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      backgroundColor: Colors.white,
      body: Container(
        height: size.height,
        width: size.width,
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
            ButtonMainWidget(
                title: 'دخول',
                onTap: () {
                    //check();
                  Get.offAll(() => LoginScreen());
                },
                size: size),

          ],
        ),
      ),
    );
  }
}
