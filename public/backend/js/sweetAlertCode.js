$(function(){
    $(document).on('click','#delete', function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
        }
      });
    });
  });


  /* for id = accept */
  $(function(){
    $(document).on('click','#accept', function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
        title: "Are you sure to accept?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, accept it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire({
            title: "Accepted!",
            text: "This order has beed accepted",
            icon: "success"
          });
        }
      });
    });
  });
  /* end id = accept */

  /* for id = processing */
  $(function(){
    $(document).on('click','#processing', function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
        title: "Are you sure to processing?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, processing it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire({
            title: "Processing!",
            text: "This order is processing",
            icon: "success"
          });
        }
      });
    });
  });
  /* end id = processing */

  /* for id = picked */
  $(function(){
    $(document).on('click','#picked', function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
        title: "Are you sure to picked?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, picked it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire({
            title: "Picked!",
            text: "This order has been picked",
            icon: "success"
          });
        }
      });
    });
  });
  /* end id = picked */

  /* for id = shipped */
  $(function(){
    $(document).on('click','#shipped', function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
        title: "Are you sure to shipped?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, shipped it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire({
            title: "Shipped!",
            text: "This order has been shipped",
            icon: "success"
          });
        }
      });
    });
  });
  /* end id = shipped */

  /* for id = delivered */
  $(function(){
    $(document).on('click','#delivered', function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
        title: "Are you sure to delivered?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delivered it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire({
            title: "Delivered!",
            text: "This order has been delivered",
            icon: "success"
          });
        }
      });
    });
  });
  /* end id = delivered */

  /* for id = cancel */
  $(function(){
    $(document).on('click','#canceled', function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
        title: "Are you sure to cancel?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link;
          Swal.fire({
            title: "Canceled!",
            text: "This order has been canceled",
            icon: "success"
          });
        }
      });
    });
  });
  /* end id = canceled */