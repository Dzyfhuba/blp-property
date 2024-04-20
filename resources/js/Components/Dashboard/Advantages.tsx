import styles from './Advantages.module.css'
import { FaLocationDot } from 'react-icons/fa6'
import { IoIosHome, IoMdCheckboxOutline } from 'react-icons/io'
import BgImage from '@/Images/bg-service-1.jpg'
import { SlStar } from 'react-icons/sl'

const Advantages = () => {
  const advantages = [
    {
      icon: <FaLocationDot size={48} />,
      title: 'Lokasi Strategis',
      descrition: 'Di dalam kawasan perumahan mandiri berkembang'
    },
    {
      icon: <IoIosHome size={48} />,
      title: 'Desain Modern',
      descrition: 'Desain dan spesifikasi rumah modern'
    },
    {
      icon: <IoMdCheckboxOutline size={48} />,
      title: 'Investasi Terbaik',
      descrition: 'BLP terpercaya sejak 1981 di Gresik, dengan perkembangan yang selalu meningkat setiap tahunnya'
    },
    {
      icon: <SlStar size={48} />,
      title: 'Investasi Terbaik',
      descrition: 'BLP terpercaya sejak 1981 di Gresik, dengan perkembangan yang selalu meningkat setiap tahunnya'
    },
  ]

  return (
    <section id="advantages"
      className={styles.container}
    >
      <div className={styles.sloganContainer}>
        <img src={BgImage}
          alt={`${import.meta.env.VITE_APP_NAME} Advantages`}
          className={styles.background}
        />
        <span className={styles.slogan}>BLP Property, Build For Better Life</span>
      </div>
      <div className={styles.advantages}>
        <h2>Keunggulan Kami</h2>
        <div className={styles.gridList}>
          {advantages.map((item, idx) => (
            <div key={idx}
              className={styles.gridItem}
            >
              {item.icon}
              <h3>{item.title}</h3>
              <p>{item.descrition}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

export default Advantages
