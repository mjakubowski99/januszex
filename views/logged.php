<html>
  <head>
  </head>

  <body>
        <script>
            let token = <?php echo json_encode($data['token']); ?>;
            localStorage.setItem('token', token);
        </script>
  </body>
</html>