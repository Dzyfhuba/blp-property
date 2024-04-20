import Image from "@/Components/Image";
import Layout from "@/Layouts/Layout";
import { PageProps } from "@/types";
import { Parser } from "html-to-react";

interface Props extends PageProps {
    data: {
        title?: string;
        content?: string;
        image?: string;
    };
}

const About = (props: Props) => {
    //console.log(props.data)
    return (
        <Layout {...props}>
            {/* kerjakan di sini */}
            <div className="pt-20 prose mx-auto">
                <Image
                src={'/storage/'+props.data.image}
                zoomable
                />
                <h1>{props.data.title}</h1>
                <div className="">{Parser().parse(props.data.content)}</div> 
            </div>
        </Layout>
    );
};

export default About;
