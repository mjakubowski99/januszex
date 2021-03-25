<html>
  <head>
  </head>

  <body>
        <script>
            let token = <?php echo json_encode($data['jwt_token']); ?>;
            localStorage.setItem('jwt_token', token);
        </script>
  </body>
</html>