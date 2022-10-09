export default interface IUser {
    id: number,
    data: Object,
    email: String,
    password: String,
    remember: Boolean,
    token: Object|null
}
