import { router } from "@inertiajs/react"
import { route } from "ziggy-js";


export default function Entry()
{
    console.log(route('init'));
    return <>
    <div className="flex items-center justify-center bg-blue-800 w-screen h-screen">
        </div>
    </>
}