export default interface IUser {
    id: number,
    data: Object,
    email: string,
    password: string,
    remember: Boolean,
    token: Object|null
}
