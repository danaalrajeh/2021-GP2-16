import 'package:flutter/material.dart';
import 'package:maak/res/app_constants.dart';

class ButtonMainWidget extends StatelessWidget {
  const ButtonMainWidget({
    Key? key,
    required this.title,
    required this.onTap,
    required this.size,
  }) : super(key: key);
  final String title;
  final void Function() onTap;
  final Size size;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        width: size.width * 0.55,
        height: size.height * 0.07,
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
        child: Center(
          child: Text(
            title,
            style: AppConstants.buttonStyle,
          ),
        ),
      ),
    );
  }
}
