<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Responsive design breakpoints example</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      .form-box {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 8px;
        background-color: #333;
        text-align: center;
      }
      .form-box input,
      .form-box button {
        padding: 8px;
        margin-right: 4px;
        font-size: 14px;
      }
      .form-box input {
        outline: none;
        border: none;
      }
      .form-box button {
        border: none;
        background-color: #edae39;
      }

      @media only screen and (max-width: 1024px) {
        .form-box input,
        .form-box button {
          display: block;
          width: 100%;
          font-size: 16px;
        }
      }

      @media only screen and (max-width: 768px) {
        .form-box {
          flex-direction: column;
        }
        .form-box input,
        .form-box button {
          display: block;
          width: 100%;
          font-size: 20px;
        }
      }
    </style>
  </head>

  <body>
    <div class="form-box">
      <input type="text" value="Username" />
      <input type="password" value="Password" />
      <button>Login</button>
    </div>
  </body>
</html>