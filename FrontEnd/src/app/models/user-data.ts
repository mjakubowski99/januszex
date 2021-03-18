import jwt_decode from 'jwt-decode';

export class UserData {

  public email: string;
  private _token: string;
  private _tokenExpirationDate: Date;

  constructor(token: string) {
    this._token = token;
    const decodeToken = jwt_decode(token);
    // @ts-ignore
    this.email = decodeToken.email;
    // @ts-ignore
    this._tokenExpirationDate = new Date(new Date().getTime() + decodeToken.exp * 1000);
    console.log(this.email);
    console.log(this._token);
    console.log(this._tokenExpirationDate);
  }

  get token(): any {
    if (!this._tokenExpirationDate || new Date() > this._tokenExpirationDate) {
      return null;
    }
    return this._token;
  }
}
