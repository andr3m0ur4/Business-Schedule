export default interface IUser {
    id: number,
    data: object,
    email: string,
    password: string,
    remember: boolean,
    token: object|null,
}
