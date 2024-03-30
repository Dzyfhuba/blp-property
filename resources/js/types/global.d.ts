import { AxiosInstance } from 'axios'
import ziggyRoute from 'ziggy-js'

export { }

declare global {
    interface Window {
        axios: AxiosInstance;
    }
    const route: typeof ziggyRoute
}


