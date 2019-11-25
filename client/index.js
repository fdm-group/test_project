const express = require("express"); // used to create APIs
const cors = require("cors");
const axios = require("axios");
//start our app
const app = express();

app.use(cors());

app.get("/api", (req, res) => {
  const user = req.query.user || "afshan";
  axios.get("https://api.github.com/users/tom").then(response => {
    res.json({ user: response.data });
  });
});
if (process.env.NODE_ENV === "production") {
  app.use(express.static("client/build"));

  app.get("*", (req, res) => {
    res.sendFile(path.resolve(__dirname, "client", "build", "index.html"));
  });
}

//const PORT = process.env.PORT || 3001;
//start our server
app.listen(4000, () => {
  console.log("listening on port 3001");
});
