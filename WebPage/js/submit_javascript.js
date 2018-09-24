function toggleDisplay(num) {
numStr = num.toString();
if (document.getElementById("panelBody" + numStr).style.display == "none") {
document.getElementById("panelBody" + numStr).style.display = "block";
document.getElementById("submit" + numStr).style.display = "block";
} else {
document.getElementById("panelBody" + numStr).style.display = "none";
document.getElementById("submit" + numStr).style.display = "none";
}
}

function toggleDisplay2() {
if (document.getElementById("panelBody2").style.display == "none") {
document.getElementById("panelBody2").style.display = "block";
document.getElementById("submit2").style.display = "block";
} else {
document.getElementById("panelBody2").style.display = "none";
document.getElementById("submit2").style.display = "none";
}
}

$("#sensorType1").change(function() {
var sensorType = $("#sensorType1").val();
console.log(sensorType);
console.log("sensor type");
if (sensorType == 'Occupancy'){
document.getElementById("i2cAddress1").style.display = "none";
document.getElementById("wattage1").style.display = "none";
} else if (sensorType == 'Current'){
document.getElementById("wattage1").style.display = "block";
document.getElementById("i2cAddress1").style.display = "none";
} else {
document.getElementById("i2cAddress1").style.display = "block";
document.getElementById("wattage1").style.display = "none";
}
} );

$("#sensorType2").change(function() {
var sensorType = $("#sensorType2").val();
console.log(sensorType);
console.log("sensor type");
if (sensorType == 'Occupancy'){
document.getElementById("i2cAddress2").style.display = "none";
document.getElementById("wattage2").style.display = "none";
} else if (sensorType == 'Current'){
document.getElementById("wattage2").style.display = "block";
document.getElementById("i2cAddress2").style.display = "none";
} else {
document.getElementById("i2cAddress2").style.display = "block";
document.getElementById("wattage2").style.display = "none";
}
} );

$("#numAnalysis1").change(function() {
var numberOfAnalysis = $("#numAnalysis1").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 0){
document.getElementById("analysisInformation11").style.display = "block";
} else {
document.getElementById("analysisInformation11").style.display = "none";
}
} );

$("#numAnalysis1").change(function() {
var numberOfAnalysis = $("#numAnalysis1").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 1){
document.getElementById("analysisInformation21").style.display = "block";
} else {
document.getElementById("analysisInformation21").style.display = "none";
}
} );

$("#numAnalysis1").change(function() {
var numberOfAnalysis = $("#numAnalysis1").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 2){
document.getElementById("analysisInformation31").style.display = "block";
} else {
document.getElementById("analysisInformation31").style.display = "none";
}
} );

$("#numAnalysis2").change(function() {
var numberOfAnalysis = $("#numAnalysis2").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 0){
document.getElementById("analysisInformation12").style.display = "block";
} else {
document.getElementById("analysisInformation12").style.display = "none";
}
} );

$("#numAnalysis2").change(function() {
var numberOfAnalysis = $("#numAnalysis2").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 1){
document.getElementById("analysisInformation22").style.display = "block";
} else {
document.getElementById("analysisInformation22").style.display = "none";
}
} );

$("#numAnalysis2").change(function() {
var numberOfAnalysis = $("#numAnalysis2").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 2){
document.getElementById("analysisInformation32").style.display = "block";
} else {
document.getElementById("analysisInformation32").style.display = "none";
}
} );

$("#analysis11").change(function() {
var analysis = $("#analysis11").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation11").style.display = "none";
document.getElementById("binSpecifics11").style.display = "none";
document.getElementById("threshold11").style.display = "block";
console.log("11");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation11").style.display = "block";
document.getElementById("binSpecifics11").style.display = "block";
document.getElementById("threshold11").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation11").style.display = "none";
document.getElementById("binSpecifics11").style.display = "none";
document.getElementById("threshold11").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation11").style.display = "block";
document.getElementById("binSpecifics11").style.display = "block";
document.getElementById("threshold11").style.display = "block";
}
} );

$("#analysis21").change(function() {
var analysis = $("#analysis21").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation21").style.display = "none";
document.getElementById("binSpecifics21").style.display = "none";
document.getElementById("threshold21").style.display = "block";
console.log("21");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation21").style.display = "block";
document.getElementById("binSpecifics21").style.display = "block";
document.getElementById("threshold21").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation21").style.display = "none";
document.getElementById("binSpecifics21").style.display = "none";
document.getElementById("threshold21").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation21").style.display = "block";
document.getElementById("binSpecifics21").style.display = "block";
document.getElementById("threshold21").style.display = "block";
}
} );

$("#analysis31").change(function() {
var analysis = $("#analysis31").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation31").style.display = "none";
document.getElementById("binSpecifics31").style.display = "none";
document.getElementById("threshold31").style.display = "block";
console.log("31");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation31").style.display = "block";
document.getElementById("binSpecifics31").style.display = "block";
document.getElementById("threshold31").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation31").style.display = "none";
document.getElementById("binSpecifics31").style.display = "none";
document.getElementById("threshold31").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation31").style.display = "block";
document.getElementById("binSpecifics31").style.display = "block";
document.getElementById("threshold31").style.display = "block";
}
} );

$("#analysis12").change(function() {
var analysis = $("#analysis12").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation12").style.display = "none";
document.getElementById("binSpecifics12").style.display = "none";
document.getElementById("threshold12").style.display = "block";
console.log("12");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation12").style.display = "block";
document.getElementById("binSpecifics12").style.display = "block";
document.getElementById("threshold12").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation12").style.display = "none";
document.getElementById("binSpecifics12").style.display = "none";
document.getElementById("threshold12").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation12").style.display = "block";
document.getElementById("binSpecifics12").style.display = "block";
document.getElementById("threshold12").style.display = "block";
}
} );

$("#analysis22").change(function() {
var analysis = $("#analysis22").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation22").style.display = "none";
document.getElementById("binSpecifics22").style.display = "none";
document.getElementById("threshold22").style.display = "block";
console.log("22");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation22").style.display = "block";
document.getElementById("binSpecifics22").style.display = "block";
document.getElementById("threshold22").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation22").style.display = "none";
document.getElementById("binSpecifics22").style.display = "none";
document.getElementById("threshold22").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation22").style.display = "block";
document.getElementById("binSpecifics22").style.display = "block";
document.getElementById("threshold22").style.display = "block";
}
} );

$("#analysis32").change(function() {
var analysis = $("#analysis32").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation32").style.display = "none";
document.getElementById("binSpecifics32").style.display = "none";
document.getElementById("threshold32").style.display = "block";
console.log("32");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation32").style.display = "block";
document.getElementById("binSpecifics32").style.display = "block";
document.getElementById("threshold32").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation32").style.display = "none";
document.getElementById("binSpecifics32").style.display = "none";
document.getElementById("threshold32").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation32").style.display = "block";
document.getElementById("binSpecifics32").style.display = "block";
document.getElementById("threshold32").style.display = "block";
}
} );

$("#binChoice11").change(function() {
var bins = $("#binChoice11").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock11").style.display = "none";
document.getElementById("fromSensorBlock11").style.display = "block";
document.getElementById("summaryMethod11").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock11").style.display = "block";
document.getElementById("fromSensorBlock11").style.display = "none";
document.getElementById("summaryMethod11").style.display = "block";
} else {
document.getElementById("customTimeBlock11").style.display = "none";
document.getElementById("fromSensorBlock11").style.display = "none";
document.getElementById("summaryMethod11").style.display = "none";
}
} );

$("#binChoice21").change(function() {
var bins = $("#binChoice21").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock21").style.display = "none";
document.getElementById("fromSensorBlock21").style.display = "block";
document.getElementById("summaryMethod21").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock21").style.display = "block";
document.getElementById("fromSensorBlock21").style.display = "none";
document.getElementById("summaryMethod21").style.display = "block";
} else {
document.getElementById("customTimeBlock21").style.display = "none";
document.getElementById("fromSensorBlock21").style.display = "none";
document.getElementById("summaryMethod21").style.display = "none";
}
} );

$("#binChoice31").change(function() {
var bins = $("#binChoice31").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock31").style.display = "none";
document.getElementById("fromSensorBlock31").style.display = "block";
document.getElementById("summaryMethod31").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock31").style.display = "block";
document.getElementById("fromSensorBlock31").style.display = "none";
document.getElementById("summaryMethod31").style.display = "block";
} else {
document.getElementById("customTimeBlock31").style.display = "none";
document.getElementById("fromSensorBlock31").style.display = "none";
document.getElementById("summaryMethod31").style.display = "none";
}
} );

$("#binChoice12").change(function() {
var bins = $("#binChoice12").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock12").style.display = "none";
document.getElementById("fromSensorBlock12").style.display = "block";
document.getElementById("summaryMethod12").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock12").style.display = "block";
document.getElementById("fromSensorBlock12").style.display = "none";
document.getElementById("summaryMethod12").style.display = "block";
} else {
document.getElementById("customTimeBlock12").style.display = "none";
document.getElementById("fromSensorBlock12").style.display = "none";
document.getElementById("summaryMethod12").style.display = "none";
}
} );

$("#binChoice22").change(function() {
var bins = $("#binChoice22").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock22").style.display = "none";
document.getElementById("fromSensorBlock22").style.display = "block";
document.getElementById("summaryMethod22").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock22").style.display = "block";
document.getElementById("fromSensorBlock22").style.display = "none";
document.getElementById("summaryMethod22").style.display = "block";
} else {
document.getElementById("customTimeBlock22").style.display = "none";
document.getElementById("fromSensorBlock22").style.display = "none";
document.getElementById("summaryMethod22").style.display = "none";
}
} );

$("#binChoice32").change(function() {
var bins = $("#binChoice32").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock32").style.display = "none";
document.getElementById("fromSensorBlock32").style.display = "block";
document.getElementById("summaryMethod32").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock32").style.display = "block";
document.getElementById("fromSensorBlock32").style.display = "none";
document.getElementById("summaryMethod32").style.display = "block";
} else {
document.getElementById("customTimeBlock32").style.display = "none";
document.getElementById("fromSensorBlock32").style.display = "none";
document.getElementById("summaryMethod32").style.display = "none";
}
} );

