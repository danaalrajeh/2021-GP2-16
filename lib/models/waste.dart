// var greeting = 'السلام عليكم.';
// var critical = <String>[
//   "تعب"
// ];
// var med_name = <String>[
//   "ما اسم الدواء؟",
//   "ما اسم العلاج؟",
//   "الدواء.",
//   "العلاج.",
//   "اش اسم الدواء؟",
//   "اش اسم العلاج؟",
//   "test"];
// var dose = <String>[
//   "كم حبة اخذ؟",
//   "كم حبه اخذ؟",
//   "كم مل اخذ؟",
//   "الجرعة؟",
//   "ما الجرعة؟",
//   "اش الجرعة.",
//   "كم الجرعة.",
//   "ما الجرعة اليوم؟"];
// var med_time = <String>[
//   "متى اخذ الدواء؟",
//   "متى اخذ العلاج؟",
//   "موعد الدواء.",
//   "موعد العلاج."];
// var precaution = <String>[
//   "ما الاحتياطات الواجبة؟",
//   "ما الاحتياطات الواجبه؟",
//   "اش لازم اخذ حذري منه؟",
//   "حذر.",
//   "موانع.",
//   "مانع.",
//   "الاحتياطات."];
// var appointment = <String>[
//   "متى موعدي؟",
//   "متى موعدي؟",
//   "متى اشوف الدكتور؟",
//   "موعد.",
//   "موعدي.",
//   "موعدى.",
//   "الساعة كام موعدي؟",
//   "الساعة كام موعدى؟",
//   "متى ازور الدكتور؟",
//   "متى ازور الطبيب؟",
//   "متى ازور المستشفى؟",
//   "متى اروح المستشفى؟",
//   "متى اروح للطبيب؟",
//   "متى اروح للدكتور؟",
//   "الطبيب.",
//   "المستشفى.",
//   "الدكتور.",
//   "وقت."];
//
// if(currentText.contains(greeting)){
// NetworkHelper helper = new NetworkHelper('و عليكم السلام'); //text to speech api
// dynamic voice_speech = await helper.getData();
// setState(() {
// text = responseText + '\n' + 'و عليكم السلام';
// recognizeFinished = true;
// playSound(voice_speech);
// });
// }
// for (var crit in critical) {
// if (crit.similarityTo(currentText) >= 0.65) {
// Urgent(crit,id);
// }
// }
// for (var name in med_name) {
// if (name.similarityTo(currentText) >= 0.65) {
// Search medic = new Search('medication','prescription',id); //search database for medication name
// dynamic medicName = await medic.search();
// NetworkHelper helper = new NetworkHelper(medicName);
// dynamic voice_speech = await helper.getData();
// setState(() {
// text = responseText + '\n' + medicName;
// recognizeFinished = true;
// playSound(voice_speech);
// });
// break;
// };
// }
// for (var dos in dose) {
// if (dos.similarityTo(currentText) >= 0.65) {
// Search medic = new Search('dose','prescription',id); //search database for medication name
// dynamic medicName = await medic.search();
// NetworkHelper helper = new NetworkHelper(medicName);
// dynamic voice_speech = await helper.getData();
// setState(() {
// text = responseText + '\n' + medicName;
// recognizeFinished = true;
// playSound(voice_speech);
// });
// break;
// };
// }
// for (var time in med_time) {
// if (time.similarityTo(currentText) >= 0.65) {
// Search medic = new Search('time','prescription',id); //search database for medication name
// dynamic medicName = await medic.search();
// NetworkHelper helper = new NetworkHelper(medicName);
// dynamic voice_speech = await helper.getData();
// setState(() {
// text = responseText + '\n' + medicName;
// recognizeFinished = true;
// playSound(voice_speech);
// });
// break;
// };
// }
// for (var prec in precaution) {
// if (prec.similarityTo(currentText) >= 0.65) {
// Search medic = new Search('precautions','prescription',id); //search database for medication name
// dynamic medicName = await medic.search();
// NetworkHelper helper = new NetworkHelper(medicName);
// dynamic voice_speech = await helper.getData();
// setState(() {
// text = responseText + '\n' + medicName;
// recognizeFinished = true;
// playSound(voice_speech);
// });
// break;
// };
// }
//
// for (var app in appointment){
// if(app.similarityTo(currentText) >= 0.65){
// Search_app medic = new Search_app("`a_date`,`a_time`",'appointment',id); //search database for medication name
// dynamic respond_phrase = await medic.search();
// NetworkHelper helper = new NetworkHelper(respond_phrase);
// dynamic voice_speech = await helper.getData();
// setState(() {
// text = responseText + '\n' + respond_phrase;
// recognizeFinished = true;
// playSound(voice_speech);
// });
// break;
// };
//
// }
// /*}else{
//           /*NetworkHelper helper = new NetworkHelper('لم افهم ما تقول');
//           dynamic voice_speech = await helper.getData();
//           setState(() {
//             text = responseText + '\n' + 'لم افهم ما تقول';
//             recognizeFinished = true;
//             playSound(voice_speech);
//         });*/}*/