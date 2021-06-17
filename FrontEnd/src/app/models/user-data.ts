export class UserData {

  constructor(
    public email: string,
    public role: string,
    private _token: string,
    private _tokenExpirationDate: Date
  ) {
  }

  get token(): any {
    if (!this._tokenExpirationDate || new Date() > this._tokenExpirationDate) {
      return null;
    }
    return this._token;
  }

  isAdmin(): boolean {
    return this.role === 'admin';
  }

  isUser(): boolean {
    return this.role === 'user';
  }
}
