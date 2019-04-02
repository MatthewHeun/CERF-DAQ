function toggleDisplay(sensorNum) {
if (document.getElementById("panelBody" + sensorNum).style.display == "none") {
document.getElementById("panelBody" + sensorNum).style.display = "block";
document.getElementById("submit" + sensorNum).style.display = "block";
} else {
document.getElementById("panelBody" + sensorNum).style.display = "none";
document.getElementById("submit" + sensorNum).style.display = "none";
}
}

$("#sensorType1").change(function() {
var sensorType = $("#sensorType1").val();
console.log(sensorType);
console.log("sensor type");
if (sensorType == 'Occupancy'){
document.getElementById("i2cAddress1").style.display = "none";
document.getElementById("voltage1").style.display = "none";
document.getElementById("pinNum1").style.display = "block";
document.getElementById("MQTT1").style.display = "none";
} else if (sensorType == 'Current'){
document.getElementById("voltage1").style.display = "block";
document.getElementById("i2cAddress1").style.display = "block";
document.getElementById("pinNum1").style.display = "block";
document.getElementById("MQTT1").style.display = "none";
} else if (sensorType == 'MQTT'){
document.getElementById("voltage1").style.display = "none";
document.getElementById("i2cAddress1").style.display = "none";
document.getElementById("pinNum1").style.display = "none";
document.getElementById("MQTT1").style.display = "block";
} else {
document.getElementById("i2cAddress1").style.display = "block";
document.getElementById("voltage1").style.display = "none";
document.getElementById("pinNum1").style.display = "block";
document.getElementById("MQTT1").style.display = "none";
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

