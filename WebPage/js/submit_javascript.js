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

$("#sensorType2").change(function() {
var sensorType = $("#sensorType2").val();
console.log(sensorType);
console.log("sensor type");
if (sensorType == 'Occupancy'){
document.getElementById("i2cAddress2").style.display = "none";
document.getElementById("voltage2").style.display = "none";
document.getElementById("pinNum2").style.display = "block";
document.getElementById("MQTT2").style.display = "none";
} else if (sensorType == 'Current'){
document.getElementById("voltage2").style.display = "block";
document.getElementById("i2cAddress2").style.display = "block";
document.getElementById("pinNum2").style.display = "block";
document.getElementById("MQTT2").style.display = "none";
} else if (sensorType == 'MQTT'){
document.getElementById("voltage2").style.display = "none";
document.getElementById("i2cAddress2").style.display = "none";
document.getElementById("pinNum2").style.display = "none";
document.getElementById("MQTT2").style.display = "block";
} else {
document.getElementById("i2cAddress2").style.display = "block";
document.getElementById("voltage2").style.display = "none";
document.getElementById("pinNum2").style.display = "block";
document.getElementById("MQTT2").style.display = "none";
}
} );

$("#sensorType3").change(function() {
var sensorType = $("#sensorType3").val();
console.log(sensorType);
console.log("sensor type");
if (sensorType == 'Occupancy'){
document.getElementById("i2cAddress3").style.display = "none";
document.getElementById("voltage3").style.display = "none";
document.getElementById("pinNum3").style.display = "block";
document.getElementById("MQTT3").style.display = "none";
} else if (sensorType == 'Current'){
document.getElementById("voltage3").style.display = "block";
document.getElementById("i2cAddress3").style.display = "block";
document.getElementById("pinNum3").style.display = "block";
document.getElementById("MQTT3").style.display = "none";
} else if (sensorType == 'MQTT'){
document.getElementById("voltage3").style.display = "none";
document.getElementById("i2cAddress3").style.display = "none";
document.getElementById("pinNum3").style.display = "none";
document.getElementById("MQTT3").style.display = "block";
} else {
document.getElementById("i2cAddress3").style.display = "block";
document.getElementById("voltage3").style.display = "none";
document.getElementById("pinNum3").style.display = "block";
document.getElementById("MQTT3").style.display = "none";
}
} );

$("#sensorType4").change(function() {
var sensorType = $("#sensorType4").val();
console.log(sensorType);
console.log("sensor type");
if (sensorType == 'Occupancy'){
document.getElementById("i2cAddress4").style.display = "none";
document.getElementById("voltage4").style.display = "none";
document.getElementById("pinNum4").style.display = "block";
document.getElementById("MQTT4").style.display = "none";
} else if (sensorType == 'Current'){
document.getElementById("voltage4").style.display = "block";
document.getElementById("i2cAddress4").style.display = "block";
document.getElementById("pinNum4").style.display = "block";
document.getElementById("MQTT4").style.display = "none";
} else if (sensorType == 'MQTT'){
document.getElementById("voltage4").style.display = "none";
document.getElementById("i2cAddress4").style.display = "none";
document.getElementById("pinNum4").style.display = "none";
document.getElementById("MQTT4").style.display = "block";
} else {
document.getElementById("i2cAddress4").style.display = "block";
document.getElementById("voltage4").style.display = "none";
document.getElementById("pinNum4").style.display = "block";
document.getElementById("MQTT4").style.display = "none";
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

$("#numAnalysis3").change(function() {
var numberOfAnalysis = $("#numAnalysis3").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 0){
document.getElementById("analysisInformation13").style.display = "block";
} else {
document.getElementById("analysisInformation13").style.display = "none";
}
} );

$("#numAnalysis3").change(function() {
var numberOfAnalysis = $("#numAnalysis3").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 1){
document.getElementById("analysisInformation23").style.display = "block";
} else {
document.getElementById("analysisInformation23").style.display = "none";
}
} );

$("#numAnalysis3").change(function() {
var numberOfAnalysis = $("#numAnalysis3").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 2){
document.getElementById("analysisInformation33").style.display = "block";
} else {
document.getElementById("analysisInformation33").style.display = "none";
}
} );

$("#numAnalysis4").change(function() {
var numberOfAnalysis = $("#numAnalysis4").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 0){
document.getElementById("analysisInformation14").style.display = "block";
} else {
document.getElementById("analysisInformation14").style.display = "none";
}
} );

$("#numAnalysis4").change(function() {
var numberOfAnalysis = $("#numAnalysis4").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 1){
document.getElementById("analysisInformation24").style.display = "block";
} else {
document.getElementById("analysisInformation24").style.display = "none";
}
} );

$("#numAnalysis4").change(function() {
var numberOfAnalysis = $("#numAnalysis4").val();
console.log(numberOfAnalysis);
console.log("number of analysis");
if (parseInt(numberOfAnalysis) > 2){
document.getElementById("analysisInformation34").style.display = "block";
} else {
document.getElementById("analysisInformation34").style.display = "none";
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

$("#analysis13").change(function() {
var analysis = $("#analysis13").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation13").style.display = "none";
document.getElementById("binSpecifics13").style.display = "none";
document.getElementById("threshold13").style.display = "block";
console.log("13");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation13").style.display = "block";
document.getElementById("binSpecifics13").style.display = "block";
document.getElementById("threshold13").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation13").style.display = "none";
document.getElementById("binSpecifics13").style.display = "none";
document.getElementById("threshold13").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation13").style.display = "block";
document.getElementById("binSpecifics13").style.display = "block";
document.getElementById("threshold13").style.display = "block";
}
} );

$("#analysis23").change(function() {
var analysis = $("#analysis23").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation23").style.display = "none";
document.getElementById("binSpecifics23").style.display = "none";
document.getElementById("threshold23").style.display = "block";
console.log("23");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation23").style.display = "block";
document.getElementById("binSpecifics23").style.display = "block";
document.getElementById("threshold23").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation23").style.display = "none";
document.getElementById("binSpecifics23").style.display = "none";
document.getElementById("threshold23").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation23").style.display = "block";
document.getElementById("binSpecifics23").style.display = "block";
document.getElementById("threshold23").style.display = "block";
}
} );

$("#analysis33").change(function() {
var analysis = $("#analysis33").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation33").style.display = "none";
document.getElementById("binSpecifics33").style.display = "none";
document.getElementById("threshold33").style.display = "block";
console.log("33");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation33").style.display = "block";
document.getElementById("binSpecifics33").style.display = "block";
document.getElementById("threshold33").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation33").style.display = "none";
document.getElementById("binSpecifics33").style.display = "none";
document.getElementById("threshold33").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation33").style.display = "block";
document.getElementById("binSpecifics33").style.display = "block";
document.getElementById("threshold33").style.display = "block";
}
} );

$("#analysis14").change(function() {
var analysis = $("#analysis14").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation14").style.display = "none";
document.getElementById("binSpecifics14").style.display = "none";
document.getElementById("threshold14").style.display = "block";
console.log("14");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation14").style.display = "block";
document.getElementById("binSpecifics14").style.display = "block";
document.getElementById("threshold14").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation14").style.display = "none";
document.getElementById("binSpecifics14").style.display = "none";
document.getElementById("threshold14").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation14").style.display = "block";
document.getElementById("binSpecifics14").style.display = "block";
document.getElementById("threshold14").style.display = "block";
}
} );

$("#analysis24").change(function() {
var analysis = $("#analysis24").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation24").style.display = "none";
document.getElementById("binSpecifics24").style.display = "none";
document.getElementById("threshold24").style.display = "block";
console.log("24");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation24").style.display = "block";
document.getElementById("binSpecifics24").style.display = "block";
document.getElementById("threshold24").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation24").style.display = "none";
document.getElementById("binSpecifics24").style.display = "none";
document.getElementById("threshold24").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation24").style.display = "block";
document.getElementById("binSpecifics24").style.display = "block";
document.getElementById("threshold24").style.display = "block";
}
} );

$("#analysis34").change(function() {
var analysis = $("#analysis34").val();
console.log(analysis);
console.log("analysis type");
console.log(analysis=="On-Peak Off-Peak %");
if (analysis == "On-Peak Off-Peak %"){
document.getElementById("binInformation34").style.display = "none";
document.getElementById("binSpecifics34").style.display = "none";
document.getElementById("threshold34").style.display = "block";
console.log("34");
} else if (analysis == "Min-Max"){
document.getElementById("binInformation34").style.display = "block";
document.getElementById("binSpecifics34").style.display = "block";
document.getElementById("threshold34").style.display = "none";
} else if (analysis == "kWh"){
document.getElementById("binInformation34").style.display = "none";
document.getElementById("binSpecifics34").style.display = "none";
document.getElementById("threshold34").style.display = "none";
} else if (analysis == "Range Analysis"){
document.getElementById("binInformation34").style.display = "block";
document.getElementById("binSpecifics34").style.display = "block";
document.getElementById("threshold34").style.display = "block";
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

$("#binChoice13").change(function() {
var bins = $("#binChoice13").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock13").style.display = "none";
document.getElementById("fromSensorBlock13").style.display = "block";
document.getElementById("summaryMethod13").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock13").style.display = "block";
document.getElementById("fromSensorBlock13").style.display = "none";
document.getElementById("summaryMethod13").style.display = "block";
} else {
document.getElementById("customTimeBlock13").style.display = "none";
document.getElementById("fromSensorBlock13").style.display = "none";
document.getElementById("summaryMethod13").style.display = "none";
}
} );

$("#binChoice23").change(function() {
var bins = $("#binChoice23").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock23").style.display = "none";
document.getElementById("fromSensorBlock23").style.display = "block";
document.getElementById("summaryMethod23").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock23").style.display = "block";
document.getElementById("fromSensorBlock23").style.display = "none";
document.getElementById("summaryMethod23").style.display = "block";
} else {
document.getElementById("customTimeBlock23").style.display = "none";
document.getElementById("fromSensorBlock23").style.display = "none";
document.getElementById("summaryMethod23").style.display = "none";
}
} );

$("#binChoice33").change(function() {
var bins = $("#binChoice33").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock33").style.display = "none";
document.getElementById("fromSensorBlock33").style.display = "block";
document.getElementById("summaryMethod33").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock33").style.display = "block";
document.getElementById("fromSensorBlock33").style.display = "none";
document.getElementById("summaryMethod33").style.display = "block";
} else {
document.getElementById("customTimeBlock33").style.display = "none";
document.getElementById("fromSensorBlock33").style.display = "none";
document.getElementById("summaryMethod33").style.display = "none";
}
} );

$("#binChoice14").change(function() {
var bins = $("#binChoice14").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock14").style.display = "none";
document.getElementById("fromSensorBlock14").style.display = "block";
document.getElementById("summaryMethod14").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock14").style.display = "block";
document.getElementById("fromSensorBlock14").style.display = "none";
document.getElementById("summaryMethod14").style.display = "block";
} else {
document.getElementById("customTimeBlock14").style.display = "none";
document.getElementById("fromSensorBlock14").style.display = "none";
document.getElementById("summaryMethod14").style.display = "none";
}
} );

$("#binChoice24").change(function() {
var bins = $("#binChoice24").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock24").style.display = "none";
document.getElementById("fromSensorBlock24").style.display = "block";
document.getElementById("summaryMethod24").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock24").style.display = "block";
document.getElementById("fromSensorBlock24").style.display = "none";
document.getElementById("summaryMethod24").style.display = "block";
} else {
document.getElementById("customTimeBlock24").style.display = "none";
document.getElementById("fromSensorBlock24").style.display = "none";
document.getElementById("summaryMethod24").style.display = "none";
}
} );

$("#binChoice34").change(function() {
var bins = $("#binChoice34").val();
console.log(bins);
if (bins == "From Sensor"){
document.getElementById("customTimeBlock34").style.display = "none";
document.getElementById("fromSensorBlock34").style.display = "block";
document.getElementById("summaryMethod34").style.display = "block";
} else if (bins == "Custom Time"){
document.getElementById("customTimeBlock34").style.display = "block";
document.getElementById("fromSensorBlock34").style.display = "none";
document.getElementById("summaryMethod34").style.display = "block";
} else {
document.getElementById("customTimeBlock34").style.display = "none";
document.getElementById("fromSensorBlock34").style.display = "none";
document.getElementById("summaryMethod34").style.display = "none";
}
} );

