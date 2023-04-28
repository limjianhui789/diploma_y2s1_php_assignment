function getPDF(selector) {
    kendo.drawing.drawDOM($(selector)).then(function(group){
      kendo.drawing.pdf.saveAs(group, "Invoice.pdf");
    });
  }
  
  function getPrint(selector) {
    w = window.open();
    w.document.write($(selector).html());
    w.print();
    w.close();
  }
  
  $(document).ready(function() {
    var data = [
      { productName: "Event 1", unitPrice: 10, qty: 1 },
      { productName: "Event 2", unitPrice: "Free", qty: 1 },
      { productName: "Event 3", unitPrice: 15, qty: 1 },
      { productName: "Event 4", unitPrice: "Free", qty: 1 },
      { productName: "Event 5", unitPrice: "Free", qty: 1 },
      { productName: "Event 6", unitPrice: 10, qty: 1 }
    ];
    var schema = {
      model: {
        productName: { type: "string" },
        unitPrice: { type: "number", editable: false },
        qty: { type: "number" }
      },
      parse: function (data) {
        $.each(data, function(){
          this.total = this.qty * this.unitPrice;


        });
        return data;
      }
    };
    var aggregate = [
      { field: "qty", aggregate: "sum" },
      { field: "total", aggregate: "sum" }
    ];
    var columns = [
      { field: "productName", title: "Event", footerTemplate: "Total"},
      { field: "unitPrice", title: "Price (RM)", width: 120},
      { field: "qty", title: "Quantity", width: 120, aggregates: ["sum"], footerTemplate: "#=sum#" },
      { field: "total", title: "Total (RM)", width: 120, aggregates: ["sum"], footerTemplate: "#=sum#" }
    ];
    var grid = $("#grid").kendoGrid({
      editable: false,
      sortable: true,
      dataSource: {
        data: data,
        aggregate: aggregate,
        schema: schema,
      },
      columns: columns
    });
  
    $("#paper").kendoDropDownList({
      change: function() {
        $(".pdf-page")
          .removeClass("size-a4")
          .removeClass("size-letter")
          .removeClass("size-executive")
          .addClass(this.value());
      }
    });
  });