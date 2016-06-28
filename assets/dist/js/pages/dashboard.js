/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  "use strict";

  //Make the dashboard widgets sortable Using jquery UI
  $(".connectedSortable").sortable({
    placeholder: "sort-highlight",
    connectWith: ".connectedSortable",
    handle: ".box-header, .nav-tabs",
    forcePlaceholderSize: true,
    zIndex: 999999
  });
  $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

  //jQuery UI sortable for the todo list
  $(".todo-list").sortable({
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: true,
    zIndex: 999999
  });

  /* jQueryKnob */
  $(".knob").knob();

  //The Calender
  $("#calendar").datepicker();

  /* Morris.js Charts */
  // Sales chart
  var area = new Morris.Area({
    element: 'revenue-chart',
    resize: true,
    data: [
      {y: '2011 Q1', entrees: 2666, desserts: 2666},
      {y: '2011 Q2', entrees: 2778, desserts: 2294},
      {y: '2011 Q3', entrees: 4912, desserts: 1969},
      {y: '2011 Q4', entrees: 3767, desserts: 3597},
      {y: '2012 Q1', entrees: 6810, desserts: 1914},
      {y: '2012 Q2', entrees: 5670, desserts: 4293},
      {y: '2012 Q3', entrees: 4820, desserts: 3795},
      {y: '2012 Q4', entrees: 15073, desserts: 5967},
      {y: '2013 Q1', entrees: 10687, desserts: 4460},
      {y: '2013 Q2', entrees: 8432, desserts: 5713}
    ],
    xkey: 'y',
    ykeys: ['entrees', 'desserts'],
    labels: ['Entrees', 'Desserts'],
    lineColors: ['#a0d0e0', '#3c8dbc'],
    hideHover: 'auto'
  });
 
  //Donut Chart
  var donut = new Morris.Donut({
    element: 'sales-chart',
    resize: true,
    colors: ["#3c8dbc", "#f56954", "#00a65a"],
    data: [
      {label: "Desserts", value: 212},
      {label: "Plats chauds", value: 430},
      {label: "Entrées", value: 120}
    ],
    hideHover: 'auto'
  });

  //Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    donut.redraw();
    area.redraw();
  });

  /* The todo list plugin */
  $(".todo-list").todolist({
    onCheck: function (ele) {
      window.console.log("The element has been checked");
      return ele;
    },
    onUncheck: function (ele) {
      window.console.log("The element has been unchecked");
      return ele;
    }
  });

});
