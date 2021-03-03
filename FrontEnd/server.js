const express = require('express');
const app = express();
app.use(express.static('./dist/FrontEnd'));
app.get('/*', function (req, res) {
  res.sendFile('index.html', {root: 'dist/FrontEnd/'}
  );
});
app.listen(process.env.PORT || 8080);
